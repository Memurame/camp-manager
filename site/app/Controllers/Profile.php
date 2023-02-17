<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{

    public function index()
    {

        return view('admin/profile', [
            'user' => user()
        ]);
    }

    public function updateProfile(){

        $user = user();
        $users = model(UserModel::class);

        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username, id, '.user_id().']',
            'email'    => 'required|valid_email|is_unique[users.email,id,'.user_id().']',
            'name'    => 'required',
        ];
        $rules_msg = [
            'username' => ['is_unique' => 'Dieser Benutzername existiert bereits'],
            'email' => ['is_unique' => 'Diese Adresse existiert bereits']
        ];

        if (! $this->validate($rules, $rules_msg))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user->username = $this->request->getPost('username');
        $user->name = $this->request->getPost('name');
        $user->email = $this->request->getPost('email');

        if($user->hasChanged()){
            $users->save($user);
            return redirect()->to(route_to('profile'))
                ->with('msg_success', 'Profil wurde aktualisiert');
        } else {
            return redirect()->to(route_to('profile'))
                ->with('msg_info', 'Es wurden keine änderungen erkannt');
        }




    }

    public function updatePassword(){

        $user = user();
        $users = model(UserModel::class);

        $auth  = service('authentication');

        $rules = [
            'password-old' => 'required',
            'password-new'     => 'required|strong_password',
            'password-new-confirm' => 'required|matches[password-new]',
        ];
        $rules_msg = [
            'password-new-confirm' => ['matches' => 'Das Password stimmt nicht überein'],
        ];


        if (! $this->validate($rules,$rules_msg))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())
                ->with('msg_error', 'Es ist ein Fehler beim ändern des Passwortes aufgetretten');
        }

        if (! $auth->validate(['email' => user()->email, 'password' => $this->request->getPost('password-old')]))
        {
            return redirect()->back()->withInput()
                ->with('errors.password-old', 'Das Passwort ist nicht korrekt')
                ->with('msg_error', 'Es ist ein Fehler beim Speichern aufgetretten');;
        }

        $user->setPassword($this->request->getPost('password-new'));
        if(!$users->save($user)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())
                ->with('msg_error', 'Es ist ein Fehler beim Speichern aufgetretten');
        }

        return redirect()->to(route_to('profile'))
            ->with('msg_success', 'Profil wurde aktualisiert');

    }

}
