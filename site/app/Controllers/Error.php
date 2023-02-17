<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Error extends BaseController
{

    public function noaccess()
    {
        return view('noaccess');
    }

}
