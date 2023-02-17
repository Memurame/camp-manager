<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Models\PermissionModel;

class InstallController extends BaseController
{
    public function index()
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {


            $rules = [
                'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'password'    => 'required',
                'email'    => 'required',
                'name'    => 'required',
                'site_title'    => 'required',
                'email_fromMail'  =>  'required',
                'email_fromName'  =>  'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $seeder = \Config\Database::seeder();
            $seeder->call('InstallSeeder');

            // Create first user
            $user = new User($this->request->getPost(['username', 'email', 'name']));
            $user->setPassword($this->request->getPost('password'));
            $user->activate();

            if (! empty($this->config->ownerGroup)) {
                $userModel = $userModel->withGroup($this->config->ownerGroup);
            }
            $userModel = new UserModel();
            $userModel->save($user);

            // Add first user to group
            $groupModel = new GroupModel();
            $groupModel->addUserToGroup(1, 1);

            // add all permission to admin group
            $permissionModel = new PermissionModel();
            $permissions = $permissionModel->findAll();
            foreach($permissions as $permission){
                $groupModel->addPermissionToGroup($permission['id'], 1);
            }

            // write settings
            settings()->write('site.title',$this->request->getPost('site_title'));
            settings()->write('email.fromName',$this->request->getPost('email_fromName'));
            settings()->write('email.fromMail',$this->request->getPost('email_fromMail'));

            unlink(ROOTPATH . '/pending_install');

            return redirect()->route('login');

        }

        return view('install/index', [
            'materiallist' => null
        ]);
    }


}