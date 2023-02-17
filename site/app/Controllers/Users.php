<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Models\PermissionModel;

class Users extends BaseController
{

    protected $config;

    public function __construct()
    {
        $this->config = config('Auth');

    }
    public function index()
    {


        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('admin/users', [
            'users' => $users,
            'config' => $this->config,
            'defaultGroups' => $this->defaultGroupID
        ]);
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if(empty($user)){
            return redirect()->route('user')->with('msg_error', lang('User.userNotFound'));
        }

        $groupModel = new GroupModel();
        $groups = $groupModel->findAll();

        $userGroups = $user->getRoles();

        $permissionModel = new PermissionModel();
        $permissions = $permissionModel->orderBy('name')->findAll();


        //die(print_r($this->defaultGroupID));
        if($_SERVER['REQUEST_METHOD'] == 'POST') {


            $rules = [
                'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username, id, '.$id.']',
                'email'    => 'required|valid_email|is_unique[users.email,id,'.$id.']',
                'name'    => 'required',
                'role'  =>  'required'
            ];
            $rules_msg = [
                'username' => ['is_unique' => 'Dieser Benutzername existiert bereits'],
                'email' => ['is_unique' => 'Diese Adresse existiert bereits']
            ];

            if (! $this->validate($rules, $rules_msg))
            {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $user->id = $id;
            $user->name = $this->request->getPost('name');
            $user->username = $this->request->getPost('username');
            $user->email = $this->request->getPost('email');
            if($this->request->getPost('force_reset_password')){
                $user->forcePasswordReset();
            }
            if($this->request->getPost('password')){
                $user->setPassword($this->request->getPost('password'));
            }

            if($this->request->getPost('status') == 'banned'){
                $user->ban('Durch einen Admin gesperrt.');
            }
            elseif($this->request->getPost('status') == 'active'){
                $user->unban();
            }

            if($user->hasChanged()) {
                $userModel->save($user);
            }

            service('log')->user('info', [
                'uid' => user_id(),
                'id' => $user->id,
                'v1' => $user->name,
                'msg' => 'Benutzer bearbeitet'
            ]);

            if((has_permission('user.permissions') and (!array_key_exists($this->defaultGroupID['owner'], $user->roles) OR (array_key_exists($this->defaultGroupID['owner'], $user->roles) AND array_key_exists($this->defaultGroupID['owner'], user()->roles))))) {
                if($this->request->getPost('role')) {
                    $groupModel->removeUserFromAllGroups($user->id);
                    foreach($this->request->getPost('role') as $val){
                        $group = $groupModel->find($val);
                        if($group){
                            $groupModel->addUserToGroup($user->id, $group->id);
                            cache()->delete("{$group->id}_users");
                        }
                    }
                }
            }


            if ($userModel->errors()) {
                return redirect()->back()->with('errors', $userModel->errors());
            }

            return redirect()->route('user.edit',[$user->id])->with('msg_success', lang('User.changesSaved'));
        }
        //die(print_r($permissionsFromGroup));
        return view('admin/users_edit', [
            'user' => $user,
            'groups' => $groups,
            'config' => $this->config,
            'defaultGroups' => $this->defaultGroupID
        ]);

    }

    public function add()
    {

        $session = session();
        $userModel = new UserModel();

        $groupModel = new GroupModel();
        $groups = $groupModel->findAll();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $request = \Config\Services::request();

            $rules = [
                'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
                'email'    => 'required|valid_email|is_unique[users.email]',
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

            $password = createRandomPassword();

            $user = new User($request->getPost(['username', 'email', 'name']));
            $user->setPassword($password);
            $user->activate();

            if (! empty($this->config->defaultUserGroup)) {
                $userModel = $userModel->withGroup($this->config->defaultUserGroup);
            }

            $userModel->save($user);

            service('log')->user('info', [
                'uid' => user_id(),
                'id' => $userModel->getInsertID(),
                'v1' => $user->name,
                'msg' => 'Neuer Benutzer erstellt'
            ]);

            if ($userModel->errors()) {
                return redirect()->back()->withInput()->with('errors', $userModel->errors());
            }

            $email = \Config\Services::email();

            $email->setFrom(settings()->read('email.fromMail'), settings()->read('email.fromName'));
            $email->setTo($user->email);

            $email->setSubject(lang('User.mailTitleNewUser'));
            $email->setMessage(view('email/newuser.php', [
                'mail' => $user->email,
                'pass' => $password]));

            $email->send();


            return redirect()->route('user')->with('msg_success', lang('User.userCreated'));
        }

        return view('admin/users_add', [
            'groups' => $groups
        ]);

    }

    public function api_delete($id){

        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $groupModel = new GroupModel();
        $permissionsModel = new PermissionModel();
        $usersModel = new UserModel();

        $user = $usersModel->find($id);
        $user->getRoles();

        if(empty($user)){
            $data['error'] = lang('User.apiUserNotFound');
        }
        elseif($user->id == user_id()){
            $data['error'] = lang('User.apiUserNoSelfDelete');
        }
        elseif(array_values($user->roles)[0] == $this->config->ownerGroup AND array_values(user()->roles)[0] == $this->config->ownerGroup){
            $data['error'] = lang('User.apiNoOwnerDelete');
        } else {
            $groupModel->removeUserFromAllGroups($user->id);
            $permissionsModel->removeAllPermissionFromUser($user->id);
            $deleted = $usersModel->delete($user->id);

            service('log')->user('info', [
                'uid' => user_id(),
                'v1' => $user->name,
                'msg' => 'Benutzer gelöscht'
            ]);

            if($deleted){
                $data['success'] = 1;
                $email = \Config\Services::email();

                $email->setFrom(settings()->read('email.fromMail'), settings()->read('email.fromName'));
                $email->setTo($user->email);

                $email->setSubject(lang('User.mailTitleUserDeleted'));
                $email->setMessage(view('email/deleteuser.php'));

                $email->send();

            } else {
                $data['error'] = lang('User.errorDelete');
            }
        }


        return $this->response->setJSON($data);

    }

    public function api_reset($id)
    {
        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $userModel = new UserModel();
        $user = $userModel->find($id);


        if(empty($user)){
            $data['error'] = lang('User.apiUserNotFound');
        } else {

            $password = createRandomPassword();

            $user->setPassword($password);
            $userModel->save($user);


            if(!$userModel->errors()){
                $data['success'] = 1;
                $email = \Config\Services::email();

                $email->setFrom(settings()->read('email.fromMail'), settings()->read('email.fromName'));
                $email->setTo($user->email);

                $email->setSubject(lang('User.mailTitleNewPass'));
                $email->setMessage(view('email/resetpassword.php', [
                    'mail' => $user->email,
                    'pass' => $password]));

                $email->send();
            } else {
                $data['error'] = lang('User.apiErrorChangePass');
            }
        }


        return $this->response->setJSON($data);
    }

}