<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class Desktop extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
