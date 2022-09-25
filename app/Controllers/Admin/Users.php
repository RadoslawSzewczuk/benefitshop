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
            'table' => prepare_table_params(
                $searchValue,
                'admin_users',
                ...( new User() )->get_users_list( $searchValue, strtolower( $orderBy ),
                    $reversed )
            )
        ]);
    }

    public function get_distributors_for_select(): \CodeIgniter\HTTP\ResponseInterface
    {
        return $this->response->setJSON(
            ( new User() )->get_distributors_for_select( ...$this->request->getPost([ 'page', 'pageSize', 'keyword' ]) )
        );
    }

    public function add_user(): bool|string
    {
        if ( !$this->request->isAJAX() )
            return false;

        if ( !$this->validate([
            'password'      => [
                'rules'     => 'required|min_length[8]|max_length[50]|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,50}$]',
                'errors'    => [
                    'required'      => 'Please fill in this field',
                    'min_length'    => 'The password provided is too short',
                    'max_length'    => 'The password provided is too long',
                    'regex_match'   => 'The password must contain at least one uppercase letter, one lowercase letter, one number and a special character'
                ]
            ],
            'email'         => [
                'rules'     => "required|valid_email|is_unique[user.email]",
                'errors'    => [
                    'required'      => 'Please enter your e-mail address',
                    'valid_email'   => 'Please enter a valid e-mail address',
                    'is_unique'     => 'An account with the given e-mail address already exists'
                ]
            ],
            'erp'           => [
                'rules'     => "required",
                'errors'    => [
                    'required'      => 'Please enter ERP',
                ]
            ],
            'company_name'  => [
                'rules'     => "required|min_length[3]|max_length[100]",
                'errors'    => [
                    'required'      => 'Please fill in this field',
                    'min_length'    => 'The company name is too short',
                    'max_length'    => 'The company name is too long',
                ]
            ],
            'rank'          => [
                'rules'     => "required|in_list[" . ADMIN_RANK_ID . "," . SECTOR_MANAGER_RANK_ID . "," . REGION_MANAGER_RANK_ID . "," . DISTRIBUTOR_RANK_ID . "]",
                'errors'    => [
                    'required'      => 'Please select a rank',
                    'in_list'       => 'Selected rank not found'
                ]
            ],
            'distributors'  => [
                'rules'     => "required",
                'errors'    => [
                    'required'      => 'Please select a distributor',
                ]
            ]
        ]))
        {
            return json_encode([
                'error' => $this->validator->getErrors(),
            ]);
        }

        $data = $this->request->getPost();
        $user_model = new User();

        $added = $user_model->insert([
            'email'         => $data['email'],
            'password'      => $data['password'],
            'erp'           => $data['erp'],
            'rank'          => $data['rank'],
            'company_name'  => $data['company_name'],
        ]);

        // TODO: add user/distributor relation to db

        return $added
            ? json_encode([
                'message' => 'User added'
            ])
            : json_encode([
                'error' => true,
                'message' => "The user could not be added, in case of further problems contact the administrator"
            ]);
    }
}
