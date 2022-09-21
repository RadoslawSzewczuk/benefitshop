<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RankSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'    => 1,
                'title' => 'Administrator'
            ],
            [
                'id'    => 2,
                'title' => 'Kierownik Sektora'
            ],
            [
                'id'    => 3,
                'title' => 'Kierownik Regionu'
            ],
            [
                'id'    => 4,
                'title' => 'Dystrybutor'
            ]
        ];

        $this->db->table('rank')->insertBatch( $data );
    }
}
