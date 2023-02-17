<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\UserModel;
use App\Models\MaterialCategoryModel;
use App\Models\MaterialModel;
use App\Entities\Material as Mat;

class Material extends BaseController
{
    public function index()
    {

        $materialModel = new MaterialModel();

        $categoryModel = new MaterialCategoryModel();
        $categories = $categoryModel->findAll();

        $materiallist = $materialModel->findAll();


        return view('material/material', [
            'materiallist' => $materiallist,
            'categories' => $categories
        ]);
    }

    public function add(){

        $materialModel = new MaterialModel();

        $categoryModel = new MaterialCategoryModel();
        $categories = $categoryModel->findAll();

        $usersModel = new UserModel();
        $users = $usersModel->findAll();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'name'  => 'required',
                'count'  => 'required',
                'category'  => 'required'
            ];

            if (! $this->validate($rules))
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());



            $material = new Mat();
            $material->name = $this->request->getPost('name');
            $material->count = $this->request->getPost('count');
            $material->description = $this->request->getPost('description');
            $material->assigned_uid = ($this->request->getPost('assign') == 0) ? null : $this->request->getPost('assign');
            $material->created_uid = user_id();
            $material->cat = $this->request->getPost('category');
            $material->status = $this->request->getPost('status');


            if (! $materialModel->save($material))
                return redirect()->back()->withInput()->with('msg_errors', $materialModel->errors());

            service('log')->material('info', [
                'uid' => user_id(),
                'id' => $materialModel->getInsertID(),
                'v1' => $material->name,
                'msg' => 'Neues Material erstellt'
            ]);

            return redirect()->route('material')->with('msg_success', 'Material wurde erfasst.');



        }

        return view('material/material_add', [
            'categories' => $categories,
            'users' => $users
        ]);
    }

    public function edit($id){

        $materialModel = new MaterialModel();
        $material = $materialModel->find($id);

        $categoryModel = new MaterialCategoryModel();
        $categories = $categoryModel->findAll();

        $usersModel = new UserModel();
        $users = $usersModel->findAll();

        if(empty($material))
            return redirect()->route('material')->withInput()->with('msg_error', 'Das aufgerufene Material existiert nicht. ');


        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'name'  => 'required',
                'count'  => 'required',
                'category'  => 'required'
            ];

            if (! $this->validate($rules))
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());



            $material->name = $this->request->getPost('name');
            $material->count = $this->request->getPost('count');
            $material->description = $this->request->getPost('description');
            $material->assigned_uid = ($this->request->getPost('assign') == 0) ? null : $this->request->getPost('assign');
            $material->cat = $this->request->getPost('category');
            $material->status = $this->request->getPost('status');

            if ($material->hasChanged()){
                if (! $materialModel->save($material))
                    return redirect()->back()->withInput()->with('msg_errors', $materialModel->errors());

                service('log')->material('info', [
                    'uid' => user_id(),
                    'id' => $material->id,
                    'v1' => $material->name,
                    'msg' => 'Material bearbeitet'
                ]);
                return redirect()->route('material')->with('msg_success', 'Material wurde bearbeitet.');
            }


            return redirect()->route('material')->with('msg_info', 'Es wurden keine änderungen festgestellt. Daher konnte nichts gespeichert werden..');

        }

        return view('material/material_edit', [
            'material' => $material,
            'categories' => $categories,
            'users' => $users
        ]);
    }

    public function api_set_status($id){

        $json_data = $this->request->getJSON('array');

        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $materialModel = new MaterialModel();
        $material = $materialModel->find($id);
        if(!$material){
            $data['error'] = "Es wurde kein Eintrag gefunden.";
            return $this->response->setJSON($data);
        }

        $material->status = $json_data['status'];
        if($materialModel->save($material)){
            $data['success'] = 1;
            $data['msg'] = "Status gespeichert";

            service('log')->material('info', [
                'uid' => user_id(),
                'id' => $material->id,
                'v1' => $material->name,
                'msg' => 'Materialstatus geändert'
            ]);
        } else {
            $data['error'] = "Beim speichern tratt ein Fehler auf.";
        }

        return $this->response->setJSON($data);

    }

    public function api_assign($id){

        $json_data = $this->request->getJSON('array');

        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $materialModel = new MaterialModel();
        $material = $materialModel->find($id);

        $userModel = new UserModel();

        if(!$material){
            $data['error'] = "Es wurde kein Eintrag gefunden.";
            return $this->response->setJSON($data);
        }
        if(!empty($material->assigned_uid) && $userModel->find($material->assigned_uid)){
            $data['error'] = "Dieses Material wurde bereits einem Benutzer zugewiesen";
            return $this->response->setJSON($data);
        }

        $user = $userModel->find($json_data['uid']);
        if(!$user){
            $data['error'] = "Der Benutzer wurde nich gefunden.";
            return $this->response->setJSON($data);
        }


        $material->assigned_uid = $json_data['uid'];
        if($materialModel->save($material)){
            $data['success'] = 1;
            $data['name'] = $user->name;
            $data['msg'] = "Benutzer zugewiesen";

            service('log')->material('info', [
                'uid' => user_id(),
                'id' => $material->id,
                'v1' => $material->name,
                'msg' => 'Materialzuweissung durch Benutzer'
            ]);
        } else {
            $data['error'] = "Beim speichern tratt ein Fehler auf.";
        }

        return $this->response->setJSON($data);

    }

    public function api_delete_material($id){

        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $materialModel = new MaterialModel();
        $material = $materialModel->find($id);
        if(!$material){
            $data['error'] = "Es wurde kein Eintrag gefunden.";
            return $this->response->setJSON($data);
        }

        service('log')->material('info', [
            'uid' => user_id(),
            'v1' => $material->name,
            'msg' => 'Material gelöscht'
        ]);

        $material = $materialModel->delete($id);
        if($material){
            $data['success'] = 1;

        } else {
            $data['error'] = "Beim speichern tratt ein Fehler auf.";
        }

        return $this->response->setJSON($data);

    }
}
