<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if ( !isLoggedIn() )
            return redirect()->to( base_url('login') );

        return redirect()->to( isAdmin() ? base_url('admin/users') : base_url() );
    }
}
