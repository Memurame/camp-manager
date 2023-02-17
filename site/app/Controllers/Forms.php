<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FormModel;

class Forms extends BaseController
{

    public function index()
    {
        $formModel = new FormModel();
        $forms = $formModel->findAll();
        return view('admin/forms',[
            'forms' => $forms
        ]);
    }

}
