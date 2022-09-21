<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Orders extends BaseController
{
    public function index(): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to( base_url('admin/orders') );
    }

    public function orders(): string
    {
        return view('welcome_message');
    }
}
