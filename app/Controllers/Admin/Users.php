<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;

class Users extends BaseController
{
    public function index(): string
    {
        list( $searchValue, $orderBy, $reversed ) = get_table_params( $this->request );

        return view('pages/admin/users', [
            'table' => prepare_table_params( $searchValue, ...( new User() )->get_users_list( $searchValue, strtolower( $orderBy ), $reversed ) )
        ]);
    }
}
