<?php

namespace App\Controllers;

use App\Models\FormModel;
use App\Models\RegistrationModel;
use App\Models\RegistrationTeamModel;
use App\Models\RegistrationLinkModel;
use App\Entities\Registration;
use App\Entities\RegistrationLink;
use League\Csv\Writer;

class Registrations extends BaseController
{
    public function index($form = null)
    {
        $getData = $this->request->getGet();

        $teamModel = new RegistrationTeamModel();
        $team = $teamModel->findAll();

        $personModel = new RegistrationModel();

        if(!isset($_GET['team'])){
            $personen = $personModel->findAll();
        } else {
            $personen = $personModel->where('team_id', $_GET['team'])->findAll();
        }

        if(isset($getData['view'])){
            if(in_array($getData['view'], ['card', 'list'])){
                $view = $getData['view'];
                $tpl = ($view == 'card') ? 'registrations/card' : 'registrations/list';
                $_SESSION['registerView'] = $view;
            } else {
                $tpl = 'registrations/list';
                $view = 'list';
                $_SESSION['registerView'] = $view;
            }
        } elseif(isset($_SESSION['registerView'])){
            if(in_array($_SESSION['registerView'], ['card', 'list'])){
                $view = $_SESSION['registerView'];
                $tpl = ($view == 'card') ? 'registrations/card' : 'registrations/list';
                $_SESSION['registerView'] = $view;
            }else{
                $tpl = 'registrations/list';
                $view = 'list';
                $_SESSION['registerView'] = $view;
            }
        } else {
            $tpl = 'registrations/list';
            $view = 'list';
            $_SESSION['registerView'] = $view;
        }


        return view($tpl, [
            'personen' => $personen,
            'teams' => $team,
            'getData' => $getData,
            'view' => $view,
        ]);
    }
    public function add()
    {
        $registrationModel = new RegistrationModel();

        $teamModel = new RegistrationTeamModel();
        $team = $teamModel->orderBy('ord', 'ASC')->findAll();


        if(isset($_GET['form'])){
            $currentForm = $this->request->getGet('form');
        } else {
            $currentForm = settings()->read('registration.form');
        }
        $formModel = new FormModel();
        $form = $formModel->find($currentForm);
        if(!$form){
            return redirect()->route('anmeldungen')->with('msg_error', lang('Form.formNotFound'));
        }
        if(!$form->active && $form->name != settings()->read('registration.form')){
            return redirect()->route('anmeldungen')->with('msg_error', lang('Form.formNotActive'));
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
                'street' => 'required',
                'street_nr' => 'required',
                'postcode' => 'required',
                'location' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'birthday' => 'required',
                'team' => 'required'
            ];
            foreach(cache('form_'.$form->name.'_required') as $required){
                $rules = array_merge($rules, [$required => 'required']);
            }

            if (! $this->validate($rules))
            {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('msg_error', lang('Registration.requiredFields'));
            }

            $registration = new Registration($this->request->getPost([
                'firstname','lastname','street','postcode','location','phone','email','birthday'
            ]));

            $data = [];
            foreach(cache('form_'.$form->name.'_fieldNames') as $fieldName){
                $data[$fieldName] = $this->request->getPost($fieldName) ?? null;
            }

            $registration->team_id = ($this->request->getPost('team') > 0) ? $this->request->getPost('team') : null;
            $registration->data_json = json_encode($data);
            $registration->form = $form->name;

            if (! $registrationModel->save($registration))
            {
                service('log')->person('warning', [
                    'uid' => user_id(),
                    'v1' => $registration->firstname . ' ' . $registration->lastname,
                    'msg' => 'Fehler beim erstellen der Person'
                ]);
                return redirect()->back()->withInput()->with('msg_error', lang('Registration.errorSave'));
            }
            $lastInsertID = $registrationModel->getInsertID();
            $registration = $registrationModel->find($lastInsertID);


            $registrationLinkModel = new RegistrationLinkModel();

            $link = new RegistrationLink();
            $link->token = createRandomPassword(30);
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


            service('log')->person('info', [
                'uid' => user_id(),
                'id' => $registration->id,
                'v1' => $registration->firstname . ' ' . $registration->lastname,
                'msg' => 'Person erstellt'
            ]);

            return redirect()->route('anmeldungen')->with('msg_success', lang('Registration.personCreated'));


        }
        return view('registrations/add', [
            'teams' => $team,
            'formFields' => cache('form_'.$form->name.'_fields')
        ]);
    }
    public function show($id)
    {
        $personModel = new RegistrationModel();
        $person = $personModel->find($id);

        if(empty($person)){
            return redirect()->route('anmeldungen')->with('msg_error', lang('Registration.userNotFound'));
        }

        $person->getJsonData();

        $formModel = new FormModel();
        $form = $formModel->find($person->form);
        if(!$form){
            return redirect()->route('anmeldungen')->with('msg_error', lang('Form.formNotFound'));
        }

        return view('registrations/detail', [
            'person' => $person,
            'formFields' => cache('form_'.$form->name.'_fields'),
            'form' => $form
            ]);
    }
    public function edit($id)
    {
        $registrationModel = new RegistrationModel();
        $person = $registrationModel->find($id);

        if(empty($person)){
            return redirect()->route('anmeldungen')->with('msg_error', lang('Registration.userNotFound'));
        }

        $person->getJsonData();


        $teamModel = new RegistrationTeamModel();

        $team = $teamModel->orderBy('ord', 'ASC')->findAll();

        $formModel = new FormModel();
        $form = $formModel->find($person->form);
        if(!$form){
            return redirect()->route('anmeldungen')->with('msg_error', lang('Form.formNotFound'));
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
                'street' => 'required',
                'street_nr' => 'required',
                'postcode' => 'required',
                'location' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'birthday' => 'required',
                'team' => 'required'
            ];
            foreach(cache('form_'.$form->name.'_required') as $required){
                $rules = array_merge($rules, [$required => 'required']);
            }

            if (! $this->validate($rules))
            {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('msg_error', lang('Registration.requiredFields'));
            }



            $data = [];
            foreach(cache('form_'.$form->name.'_fieldNames') as $fieldName){
                $data[$fieldName] = $this->request->getPost($fieldName) ?? null;
            }

            $person->firstname = $this->request->getPost('firstname');
            $person->lastname = $this->request->getPost('lastname');
            $person->street = $this->request->getPost('street');
            $person->street_nr = $this->request->getPost('street_nr');
            $person->postcode = $this->request->getPost('postcode');
            $person->location = $this->request->getPost('location');
            $person->phone = $this->request->getPost('phone');
            $person->email = $this->request->getPost('email');
            $person->birthday = $this->request->getPost('birthday');
            $person->team_id = $this->request->getPost('team');
            $person->data_json = json_encode($data);

            if ($person->hasChanged()){
                if (! $registrationModel->save($person)){
                    service('log')->person('warning', [
                        'uid' => user_id(),
                        'v1' => $person->firstname . ' ' . $person->lastname,
                        'msg' => 'Fehler beim speichern der Person'
                    ]);
                    return redirect()->back()->withInput()->with('msg_errors', $registrationModel->errors());
                }

                service('log')->person('info', [
                    'uid' => user_id(),
                    'id' => $person->id,
                    'v1' => $person->firstname . ' ' . $person->lastname,
                    'msg' => 'Person bearbeitet'
                ]);
                return redirect()->route('anmeldungen')->with('msg_success', lang('Registration.changesSaved'));
            }
            return redirect()->route('anmeldungen')->with('msg_info', lang('Registration.noChanges'));


        }
        return view('registrations/edit', [
            'teams' => $team,
            'person' =>$person,
            'formFields' => cache('form_'.$form->name.'_fields')
        ]);
    }
    public function api_delete($id){

        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $registrationModel = new RegistrationModel();
        $person = $registrationModel->find($id);

        if(empty($person)){
            $data['error'] = lang('Registration.userNotFound');
        } else {
            $deleted = $registrationModel->delete($person->id);
            if($deleted){
                $data['success'] = 1;
                service('log')->person('info', [
                    'uid' => user_id(),
                    'v1' => $person->firstname . ' ' . $person->lastname,
                    'msg' => 'Person gelöscht'
                ]);
            } else {
                service('log')->person('warning', [
                    'uid' => user_id(),
                    'v1' => $person->firstname . ' ' . $person->lastname,
                    'msg' => 'Person konnte nicht gelöscht werden'
                ]);
                $data['error'] = lang('Registration.errorDelete');
            }
        }


        return $this->response->setJSON($data);
    }
    public function stack_edit()
    {
        $teamModel = new RegistrationTeamModel();
        $team = $teamModel->findAll();

        $registrationModel = new RegistrationModel();

        $personen = $registrationModel->findAll();


        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $request = \Config\Services::request();

            foreach($request->getVar('stack') as $key => $value){

                $person = $registrationModel->find($value['uid']);
                if(!empty($person)){
                    $person->paid = $value['paid'];
                    $person->paid_amount = (empty($value['amount'])) ? 0 : $value['amount'];
                    $person->team_id = ($value['team'] == 0) ? null : $value['team'];

                    if ($person->hasChanged()){
                        if ($registrationModel->save($person)){
                            service('log')->person('info', [
                                'uid' => user_id(),
                                'id' => $person->id,
                                'v1' => $person->firstname . ' ' . $person->lastname,
                                'msg' => 'Person per Stapelverarbeitung bearbeitet'
                            ]);
                        } else {
                            service('log')->person('warning', [
                                'uid' => user_id(),
                                'id' => $person->id,
                                'v1' => $person->firstname . ' ' . $person->lastname,
                                'msg' => 'Fehler beim speichern der Person per Stapelverarbeitung.'
                            ]);
                        }

                    }
                }
            }
            return redirect()->route('anmeldungen')->with('msg_success', lang('Registration.stackChangesSaved'));



        }


        return view('registrations/stack', [
            'personen' => $personen,
            'teams' => $team
        ]);
    }
    public function export(){
        $registrationModel = new RegistrationModel();
        if(!isset($_GET['team'])){
            $personen = $registrationModel->get_export_data();
        } else {
            $personen = $registrationModel->get_export_data($_GET['team']);
        }

        $header = ['Nachname', 'Vorname', 'Strasse', 'Hausnummer', 'PLZ', 'Ort', 'Mail', 'Telefon', 'Geburtsdatum'];

        $csv = Writer::createFromString();
        $csv->insertOne($header);

        $csv->insertAll($personen);

        $file = '../writable/uploads/export.csv';
        $datum = date("Y-m-d_H:i");
        file_put_contents($file, $csv->toString());


        header('Content-type: text/csv');
        header('Content-disposition:attachment; filename="'.$datum .'_export.csv"');
        readfile($file);
    }

}