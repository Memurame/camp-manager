<?php

namespace App\Controllers;

use App\Models\FormModel;
use App\Models\RegistrationModel;
use App\Models\RegistrationLinkModel;
use App\Models\GroupModel;
use App\Entities\Registration;
use App\Entities\RegistrationLink;
use League\Csv\Writer;

class PublicController extends BaseController
{

    public function register($form){

        $registrationModel = new RegistrationModel();

        if($form){
            $currentForm = $form;
        } else {
            $currentForm = settings()->read('registration.form');
        }

        $formModel = new FormModel();
        $form = $formModel->find($currentForm);
        if(!$form){
            return redirect()->route('public.index')->with('msg_error', lang('Form.formNotFound'));
        }
        if(!$form->active && $form->name != settings()->read('registration.form')){
            return redirect()->route('public.index')->with('msg_error', lang('Form.formNotActive'));
        }

        $ref = null;
        if(isset($_GET['ref'])){
            $registrationLinkModel = new RegistrationLinkModel();
            $ref = $registrationLinkModel->where('token', $_GET['ref'])->first();

        }

        if(!settings()->read('registration.allowRegistration')){
            return view('public/disabled', [
                'form' => $form
            ]);
        }
        
    
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
                'street' => 'required',
                'postcode' => 'required',
                'location' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'birthday' => 'required',
                'street_nr' => 'required'
            ];
            foreach (cache('form_' . $form->name . '_required') as $required) {
                $rules = array_merge($rules, [$required => 'required']);
            }

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('msg_error', lang('Registration.requiredFields'));
            }

            $registration = new Registration($this->request->getPost([
                'firstname', 'lastname', 'street', 'postcode', 'location', 'phone', 'email', 'birthday', 'street_nr'
            ]));

            $data = [];
            foreach (cache('form_' . $form->name . '_fieldNames') as $fieldName) {
                $data[$fieldName] = $this->request->getPost($fieldName) ?? null;
            }

            $registration->team_id = null;
            $registration->data_json = json_encode($data);
            $registration->form = $form->name;

            if (!$registrationModel->save($registration)) {
                service('log')->person('warning', [
                    'v1' => $registration->firstname . ' ' . $registration->lastname,
                    'msg' => 'Fehler beim erstellen der Person'
                ]);
                return redirect()->back()->withInput()->with('msg_error', lang('Registration.errorSave'));
            }

            $lastInsertID = $registrationModel->getInsertID();
            $registration = $registrationModel->find($lastInsertID);

            service('log')->person('info', [
                'id' => $lastInsertID,
                'v1' => $registration->firstname . ' ' . $registration->lastname,
                'msg' => 'Anmeldung durch Teilnehmer'
            ]);

            $registrationLinkModel = new RegistrationLinkModel();

            $link = new RegistrationLink();
            $link->token = ($ref) ? $ref->token : createRandomPassword(30);
            $link->registrations_id = $lastInsertID;
            $registrationLinkModel->save($link);


            $email = \Config\Services::email();

            $email->setFrom(settings()->read('email.fromMail'), settings()->read('email.fromName'));
            $email->setTo($registration->email);

            $email->setSubject("Neue Anmeldung");
            $email->setMessage(view('email/registration.php', [
                'person' => $registration,
                'link' => $link,
                'url' => route_to('public.my', $link->token)]));

            $email->send();


            $groupModel = new GroupModel();
            $mailusers = $groupModel->getUsersForSystemmails();

            foreach($mailusers as $mailuser){
                $email = \Config\Services::email();

                $email->setFrom(settings()->read('email.fromMail'), settings()->read('email.fromName'));
                $email->setTo($mailuser['email']);

                $email->setSubject("Neue Anmeldung");
                $email->setMessage(view('email/newperson.php', [
                    'person' => $registration]));

                $email->send();
            }
            
            return redirect()->route('public.my', [$link->token])->with('msg_success', lang('Registration.personCreated'));
        }



        return view('public/register', [

            'formFields' => cache('form_'.$form->name.'_fields'),
            'form' => $form
        ]);
    }
    public function my($token){

        $registrationLinkModel = new RegistrationLinkModel();
        $my = $registrationLinkModel->getMy($token);

        if(empty($my)){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('public/my', [

            'registrations' => $my,
            'token' => $token,
            'form' => $my[0]->form
        ]);
    }

    public function detail($token, $id){

        $registrationLinkModel = new RegistrationLinkModel();

        $registrationModel = new RegistrationModel();
        $detail = $registrationModel->find($id);

        if(empty($detail)){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        print_r($detail);
        die();

        return view('public/my_detail', [
            'detail' => $detail,
        ]);
    }

}