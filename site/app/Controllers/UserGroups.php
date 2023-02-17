<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Entities\UserGroup;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Models\PermissionModel;

class UserGroups extends BaseController
{

    protected $config;

    public function __construct()
    {
        $this->config = config('Auth');
    }

    public function index()
    {


        $groupModel = new GroupModel();
        $groups = $groupModel->findAll();

        return view('admin/groups', [
            'groups' => $groups,
            'config' => $this->config,
            'defaultGroups' => $this->defaultGroupID
        ]);
    }

    public function add(){


        $permissionModel = new PermissionModel();
        $permissions = $permissionModel->orderBy('name')->findAll();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $groupModel = new GroupModel();

            $group = new UserGroup();
            $group->name = $this->request->getPost('name');
            $group->description = $this->request->getPost('description');
            $group->mails = ($this->request->getPost('systemmails') == 1) ? 1 : 0;

            $rules = [
                'name' => 'required|max_length[255]|is_unique[auth_groups.name]',
                'description' => 'required|max_length[255]',
            ];
            $rules_msg = [
                'name'        => [
                    'required' => 'Dieses Feld darf nicht leer sein',
                    'is_unique' => 'Diese Gruppe existiert bereits',
                ],
                'description'        => [
                    'required' => 'Dieses Feld darf nicht leer sein',
                ],
            ];

            if (! $this->validate($rules, $rules_msg)){
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            if (! $groupModel->save($group))
            {
                return redirect()->back()->withInput()->with('errors', $group->errors());
            }
            

            service('log')->userGroup('info', [
                'uid' => user_id(),
                'id' => $groupModel->getInsertID(),
                'v1' => $group->name,
                'msg' => 'Neue Benutzergruppe erstellt'
            ]);

            $insertID = $groupModel->getInsertID();

            if ($this->request->getPost('permission')) {
                foreach ($this->request->getPost('permission') as $key => $val) {
                    $groupModel->addPermissionToGroup($key, $insertID);
                }
            }

            return redirect()->route('group')->with('msg_success', 'Die Gruppe wurde gespeichert.');
        }

        return view('admin/groups_add', [
            'permissions' => $permissions
        ]);

    }

    public function edit($id){

        $groupModel = new GroupModel();
        $group = $groupModel->find($id);

        if(!$group){
            return redirect()->back()->withInput()->with('msg_error', 'Die aufgerufene Gruppe existiert nicht');
        }

        if(($group->id == $this->defaultGroupID['owner'] AND !array_key_exists($this->defaultGroupID['owner'], user()->roles)) or !has_permission('group.edit')){
            return redirect()->back()->withInput()->with('msg_error', 'Du hast keine Berechtigung diese Gruppe zu bearbeiten');
        }

        $permissionsFromGroup = $groupModel->getPermissionsForGroup($group->id);

        $permissionModel = new PermissionModel();
        $permissions = $permissionModel->orderBy('name')->findAll();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(!in_array($group->id, $this->defaultGroupID)){
                $group->name = $this->request->getPost('name');
            }
            
            $group->description = $this->request->getPost('description');
            $group->mails = ($this->request->getPost('systemmails') == 1) ? 1 : null;

            $rules = [
                'name' => 'required|max_length[255]|is_unique[auth_groups.name,id,'.$group->id.']',
                'description' => 'required|max_length[255]',
            ];
            $rules_msg = [
                'name'        => [
                    'required' => 'Dieses Feld darf nicht leer sein',
                    'is_unique' => 'Diese Gruppe existiert bereits',
                ],
                'description'        => [
                    'required' => 'Dieses Feld darf nicht leer sein',
                ],
            ];

            if (! $this->validate($rules, $rules_msg)){
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            if($group->hasChanged()){
                $groupModel->save($group);
            }

            if ($this->request->getPost('permission')) {
                $groupModel->removeAllPermissionsFromGroup($group->id);
                foreach ($this->request->getPost('permission') as $key => $val) {
                    $groupModel->addPermissionToGroup($key, $group->id);
                }
            }

            service('log')->userGroup('info', [
                'uid' => user_id(),
                'id' => $group->id,
                'v1' => $group->name,
                'msg' => 'Benutzergruppe bearbeitet'
            ]);


            $groupUsers = $groupModel->getUsersForGroup($group->id);
            foreach($groupUsers as $groupUser)
            cache()->delete("{$groupUser['id']}_groups");
            cache()->delete("{$groupUser['id']}_permissions");
            cache()->delete("{$group->id}_users");

            return redirect()->route('group')->with('msg_success', 'Die Gruppe wurde gespeichert.');
        }


        return view('admin/groups_edit', [
            'permissions' => $permissions,
            'groupPermissions' => $permissionsFromGroup,
            'defaultGroups' => $this->defaultGroupID,
            'group' => $group
        ]);

    }


    public function api_delete($id){

        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $groupModel = new GroupModel();
        $group = $groupModel->find($id);

        $userRole = array_key_first(user()->getRoles());

        if(empty($group)){
            $data['error'] = "Der Benutzer wurde nicht gefunden!";
        }
        elseif($userRole == $group->id){
            $data['error'] = "Du kannst die Gruppe der du selbst angehörst nicht löschen.";
        }
        elseif(strtolower($group->name) == strtolower($this->config->ownerGroup)){
            $data['error'] = "Die '". $group->name ."' Gruppe kann nicht gelöscht werden";
        }
        elseif(in_array($group->id, $this->defaultGroupID)){
            $data['error'] = "Die Standart Gruppe kann nicht gelöscht werden";
        }
        else {

            service('log')->userGroup('info', [
                'uid' => user_id(),
                'v1' => $group->name,
                'msg' => 'Benutzergruppe gelöscht'
            ]);

            $groupModel->removeAllUserFromGroup($group->id);
            $groupModel->delete($group->id);

            if ($groupModel->errors()) {
                $data['error'] = "Es ist ein Fehler beim löschen der Gruppe aufgetretten";
            }
            $data['success'] = 1;

        }


        return $this->response->setJSON($data);

    }

}