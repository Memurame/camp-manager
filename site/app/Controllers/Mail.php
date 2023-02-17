<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;
use App\Models\RegistrationTeamModel;
use App\Models\LogModel;
use App\Models\PersonModel;

class Mail extends BaseController
{
    public function index($time = null)
    {
        $teamModel = new RegistrationTeamModel();
        $team = $teamModel->findAll();

        $personModel = new RegistrationModel();
        $persons = $personModel->findAll();

        $directory = FCPATH . '../writable/mail/saved/';
        $exists = file_exists($directory . $time .'.json');

        return view('mail', [
            'errors' => ($time && !$exists) ? ['Der Entwurf welcher geladen werden sollte existiert nicht. Es wird ein Leeres Formular angezeigt.'] : null,
            'teams' => $team,
            'success' => null,
            'persons' => $persons,
            'entwurf' => ($time && $exists) ? json_decode(file_get_contents($directory . $time .'.json'), true) : null]);
    }

    public function detail($time)
    {
        $directory = FCPATH . '../writable/mail/done/';
        if(!file_exists($directory . $time . '.json')){
            return redirect()->route('mail.sent')->with('msg_error', lang('Mail.notExists'));
        }
        $json = json_decode(file_get_contents($directory . $time . '.json'), true);

        return view('mail_detail', [
            'mail' => $json
        ]);
    }

    public function sent($time = null)
    {
        $directory = FCPATH . '../writable/mail/done/';
        $scanned_directory = array_diff(scandir($directory), array('..', '.', 'index.html', '.DS_Store'));

        $arr = [];
        foreach($scanned_directory as $key => $file) {
            $json = json_decode(file_get_contents($directory . $file), true);
            $arr[$key] = $json;
            $arr[$key]['count'] = count($arr[$key]['to']);
        }

        return view('mail_sent', [
            'list' => $arr
        ]);
    }

    public function send(){
        $logModel = new LogModel();
        $time = time();

        $rules = [
            'input_subject' => 'required',
            'input_text'    => 'required'
        ];

        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        //die(print_r($this->request->getVar('persons')));


        $mail = [];
        $personModel = new RegistrationModel();
        if($this->request->getVar('selectGroup')){
            foreach($this->request->getVar('selectGroup') as $key => $teamid){
                $personen = $personModel->asArray()->where('team_id' ,$teamid)->findAll();
                foreach($personen as $person){

                    if(!empty($person['email'])){
                        if(!in_array( $person['email'] ,$mail )){
                            $mail[] = $person['email'];
                        }

                    } else {

                        $logModel->mail('error', [
                            'uid' => user_id(),
                            'id' => $person['id'],
                            'v1' => $person['firstname'] . ' ' . $person['lastname'],
                            'v2' => $time,
                            'msg' => 'Keine Kontaktangaben gefunden.'
                        ]);

                    }

                }
            }
        }

        if($this->request->getVar('persons')){
            foreach($this->request->getVar('persons') as $selectedPersonID){
                $person = $personModel->asArray()->find($selectedPersonID);
                if(!empty($person['email'])){
                    if(!in_array( $person['email'] ,$mail )){
                        $mail[] = $person['email'];
                    }
                } else {
                    $logModel->mail('error', [
                        'uid' => user_id(),
                        'id' => $person['id'],
                        'v1' => $person['firstname'] . ' ' . $person['lastname'],
                        'v2' => $time,
                        'msg' => 'Keine Kontaktangaben gefunden.'
                    ]);
                }
            }
        }

        if(!$mail){
            return redirect()->back()->withInput()->with('msg_error', lang('Mail.noReceiverFound'));
        }

        $parser = new \Parsedown();
        $data = [
            'typ' => 'form',
            'time' => $time,
            'to' => $mail,
            'reply_to' => (!empty($this->request->getVar('input_sender'))) ? $this->request->getVar('input_sender') : null,
            'subject' => $this->request->getVar('input_subject'),
            'text' => $parser->setBreaksEnabled(true)->text($this->request->getVar('input_text')),
            'uid' => user_id(),
        ];
        file_put_contents(FCPATH . '../writable/mail/queue/' . $time .'.json', json_encode($data));

        return redirect()->route('mail')
            ->with('msg_success', 'Die Mails werden in den nächsten 5 Minuten automatisch versendet.');




    }

    public function save($time = null){
        $session = session();

        $request = \Config\Services::request();

        $time = ($time) ? $time : time();
        $data = [
            'typ' => 'form',
            'time' => $time,
            'name' => (!empty($request->getVar('save_name'))) ? $request->getVar('save_name') : 'Entwurf ohne Namen',
            'reply_to' => (!empty($request->getVar('input_sender'))) ? $request->getVar('input_sender') : null,
            'subject' => $request->getVar('input_subject'),
            'text' => $request->getVar('input_text')
        ];

        file_put_contents(FCPATH . '../writable/mail/saved/' . $time .'.json', json_encode($data));



        return redirect()->route('mail.saved')
            ->with('msg_success', 'Das Mail wurde als Entwurf gespeichert.');




    }

    public function saved($time = null){

        $directory = FCPATH . '../writable/mail/saved/';
        $scanned_directory = array_diff(scandir($directory), array('..', '.', 'index.html', '.DS_Store'));

        $arr = [];
        foreach($scanned_directory as $key => $file) {
            $json = json_decode(file_get_contents($directory . $file), true);
            $arr[$key] = $json;
        }

        $exists = file_exists($directory . $time .'.json');

        if(!$time && $arr){
            return redirect()->route('mail.load', [$arr[array_key_first($arr)]['time']]);
        }


        return view('mail_saved', [
            'list' => $arr,
            'entwurf' => ($time && $exists) ? json_decode(file_get_contents($directory . $time .'.json'), true) : null]);
    }

    public function api_delete($time){

        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $directory = FCPATH . '../writable/mail/saved/';
        $exists = file_exists($directory . $time .'.json');

        if(!$exists){
            $data['error'] = "Der Entwurf wurde nicht gefunden!";
        } else {
            $deleted = unlink($directory . $time .'.json');
            if($deleted){
                $data['success'] = 1;
            } else {
                $data['error'] = "Beim löschen ist ein Fehler aufgetretten.";
            }
        }


        return $this->response->setJSON($data);
    }
}