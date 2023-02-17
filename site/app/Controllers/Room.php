<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailModel;
use App\Models\RegistrationModel;
use App\Models\RoomModel;
use App\Models\PersonModel;
use App\Entities\Room as Rm;

class Room extends BaseController
{
    public function index()
    {

        $roomModel = new RoomModel();
        $rooms = $roomModel->findAll();

        foreach($rooms as $room){
            $room->getMembers();
        }

        return view('room/room', [
            'rooms' => $rooms
        ]);
    }

    public function edit($id)
    {

        $roomModel = new RoomModel();
        $room = $roomModel->find($id);

        $personModel = new RegistrationModel();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'name' => 'required',
                'capacity'    => 'required'
            ];

            if (! $this->validate($rules))
            {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $room->name = $this->request->getVar('name');
            $room->capacity = $this->request->getVar('capacity');

            if($room->hasChanged()){
                service('log')->room('info', [
                    'uid' => user_id(),
                    'id' => $room->id,
                    'v1' => $room->name,
                    'msg' => 'Zimmer bearbeitet'
                ]);
                $roomModel->save($room);
            }



            return redirect()->route('zimmer')
                ->with('msg_success', 'Zimmer wurde bearbeitet.');


        }

        return view('room/room_edit', [
            'room' => $room,
            'persons' => $personModel->where('room_id' , ['', null]),
        ]);
    }

    public function add()
    {

        $roomModel = new RoomModel();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'name' => 'required',
                'capacity'    => 'required'
            ];

            if (! $this->validate($rules))
            {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $room = new Rm();
            $room->name = $this->request->getVar('name');
            $room->capacity = $this->request->getVar('capacity');
            $roomModel->save($room);

            service('log')->room('info', [
                'uid' => user_id(),
                'id' => $roomModel->getInsertID(),
                'v1' => $room->name,
                'msg' => 'Neues Zimmer erstellt'
            ]);

            return redirect()->route('zimmer')
                ->with('msg_success', 'Zimmer wurde erstellt.');


        }

        return view('room/room_add');
    }

    public function api_member_delete($id){

        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $personModel = new RegistrationModel();
        $person = $personModel->find($id);

        $roomModel = new RoomModel();
        $room = $roomModel->find($person->room_id);

        if(empty($person)){
            $data['error'] = "Der Teilnehmer wurde nicht gefunden!";
        } else {
            $person->room_id = null;
            $updated = $personModel->save($person);

            if($updated){
                $data['success'] = 1;
                $data['room'] = $room;
            } else {
                $data['error'] = "Beim löschen ist ein Fehler aufgetretten.";
            }
        }


        return $this->response->setJSON($data);
    }

    public function api_member_add(){

        $request = \Config\Services::request();

        $json_data = $request->getJSON('array');

        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $roomModel = new RoomModel();
        $personModel = new RegistrationModel();

        $room = $roomModel->find($json_data['room_id']);
        $person = $personModel->find($json_data['person_id']);

        if($room && $person){

            $person->room_id = $room->id;
            $saved = $personModel->save($person);

            if($saved){
                $data['success'] = 1;
            } else {
                $data['error'] = "Beim hinzufügen ist ein Fehler aufgetretten.";
            }

            $data['person'] = $person;

            $data['room'] = $room;
        } else {
            $data['error'] = "Beim hinzufügen ist ein Fehler aufgetretten.";
        }



        return $this->response->setJSON($data);
    }

    public function api_member_list($id){

        $registerModel = new RegistrationModel();
        $members = $registerModel->where('room_id', $id)->findAll();

        $list = [];
        $list['member'] = $members;

        return $this->response->setJSON($list);
    }
    public function api_person_list(){

        $registerModel = new RegistrationModel();
        $persons = $registerModel->where('room_id', null)->findAll();


        return $this->response->setJSON($persons);
    }

    public function api_room_delete($id){

        $data = array();
        $data['success'] = 0;
        $data['token'] = csrf_hash();

        $personModel = new RegistrationModel();

        $roomModel = new RoomModel();
        $room = $roomModel->find($id);

        if(empty($room)){
            $data['error'] = "Das Zimmer wurde nicht gefunden!";
        } else {

            service('log')->room('info', [
                'uid' => user_id(),
                'v1' => $room->name,
                'msg' => 'Zimmer gelöscht'
            ]);

            $deleted = $roomModel->delete($id);

            if($deleted){
                $data['success'] = 1;
                $room_members = $personModel->where('room_id',  $id)->findAll();
                foreach($room_members as $member){
                    $member->room_id = null;
                    $personModel->save($member);
                }
            } else {
                $data['error'] = "Beim löschen ist ein Fehler aufgetretten.";
            }
        }


        return $this->response->setJSON($data);
    }
}
