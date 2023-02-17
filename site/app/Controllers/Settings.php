<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FormModel;
use Symfony\Component\Yaml\Yaml;

class Settings extends BaseController
{
    public function index()
    {
        $formModel = new FormModel();
        $forms = $formModel->findAll();

        return view('admin/settings',[
        'forms' => $forms]);
    }

    public function deleteData(){

        if(!$this->request->getPost('delete_confirm')){
            return redirect()->route('settings')->with('msg_error', 'Bitte bestätige die Löschung!');
        }

        return redirect()->route('settings')->with('msg_success', 'Daten wurden gelöscht');

    }

    public function saveSettings(){

        $rules = [
            'site_title' => 'required',
            'email_fromName' => 'required',
            'email_fromMail' => 'required',
            'auth_groupOwner' => 'required',
            'auth_groupUser' => 'required',
            'auth_allowRegistration' => 'required',
            'auth_allowRemember' => 'required',
            'auth_minLengthPasswords' => 'required',
        ];

        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        settings()->write('site.title',$this->request->getPost('site_title'));
        settings()->write('registration.form',$this->request->getPost('registration_form'));
        settings()->write('registration.allowRegistration',$this->request->getPost('registration_allowRegistration'));
        settings()->write('email.fromName',$this->request->getPost('email_fromName'));
        settings()->write('email.fromMail',$this->request->getPost('email_fromMail'));

        settings()->write('auth.ownerGroup',$this->request->getPost('auth_groupOwner'));
        settings()->write('auth.defaultUserGroup',$this->request->getPost('auth_groupUser'));
        settings()->write('auth.allowRegistration',$this->request->getPost('auth_allowRegistration'));
        settings()->write('auth.allowRemembering',$this->request->getPost('auth_allowRemember'));
        settings()->write('auth.minimumPasswordLength',$this->request->getPost('auth_minLengthPasswords'));

        cache()->delete('registrationsForm');

        return redirect()->back()->with('msg_success', 'Einstellungen wurden gespeichert');
    }
}