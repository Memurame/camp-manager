<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;
use App\Models\RegistrationTeamModel;
use App\Models\UserModel;
use App\Models\RoomModel;
use App\Models\DetailModel;
use App\Models\MaterialModel;
use Bueltge\Marksimple\Marksimple;
use Couchbase\User;

class Dashboard extends BaseController
{
    public function index()
    {
        $teamModel = new RegistrationTeamModel();
        $team = $teamModel->findAll();

        $registrationModel = new RegistrationModel();
        $materialModel = new materialModel();
        $roomModel = new roomModel();


        foreach($team as $value){
            $value->count = $registrationModel->get_count_of_row('team_id', $value->id); 
        }



        return view('dashboard', [
            'teams' => $team,
            'stats' => [
                'teilnehmer' => $registrationModel->get_count_of_row(),
                'material' => $materialModel->get_count_of_row(),
                'room' => $roomModel->get_count_of_row(),
                'chf' =>0,
            ]
        ]);
    }

}