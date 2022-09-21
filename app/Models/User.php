<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['before_insert'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['before_update'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function before_insert(array $data): array
    {
        if ( !empty( $data['data']['password'] ) )
            $data['data']['password'] = password_hash( $data['data']['password'], PASSWORD_DEFAULT );

        return $data;
    }

    protected function before_update(array $data) {
        if ( !empty( $data['data']['password'] ) )
            $data['data']['password'] = password_hash( $data['data']['password'], PASSWORD_DEFAULT );

        return $data;
    }

    public function get_users_list( string $searchValue, string $orderBy, string $reversed ): array
    {
        $mapper = [
            'id'                => ['table' => 'user', 'field' => 'id'],
            'e-mail'            => ['table' => 'user', 'field' => 'email'],
            'nazwa'             => ['table' => 'user', 'field' => 'company_name'],
            'erp id'            => ['table' => 'user', 'field' => 'erp'],
            'status'            => ['table' => 'user', 'field' => 'status'],
            'rola'              => ['table' => 'rank', 'field' => 'title'],
        ];

        $this
            ->select('user.id, user.email, user.company_name, user.erp, user.status, rank.title')
            ->join('rank', 'rank.id = user.rank')
            ->groupStart()
                ->like( 'user.email', $searchValue )
                ->orLike( 'user.company_name', $searchValue )
                ->orLike( 'user.erp', $searchValue )
                ->orLike( 'rank.title', $searchValue )
            ->groupEnd();

        if( !( empty( $orderBy ) || empty( $mapper[$orderBy] ) ) ) :
            $this->orderBy($mapper[$orderBy]['table'] . '.' . $mapper[$orderBy]['field'], $reversed);
        endif;

        return [ $this->paginate(10), $this->pager ];
    }
}
