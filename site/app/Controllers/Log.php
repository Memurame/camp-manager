<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogModel;
use App\Models\UserModel;
use Couchbase\User;

class Log extends BaseController
{
    public function index()
    {

        $logModel = new LogModel();
        $logs = $logModel->get_all_data();

        $userModel = new UserModel();

        foreach($logs as $key => $val){

            $data = json_decode($val['msg'], true);
            if(isset($data['uid'])){
                $user = $userModel->find($data['uid']);
                $logs[$key]['user'] = $user->name;
            }

            $logs[$key]['date'] = $val['created_at'];


        }

        return view('admin/log', [
            'logs' => $logs
        ]);
    }

}
