<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'                => 1,
                'email'             => 'r.szewczuk@benefitshop.pl',
                'password'          => password_hash( 'zxc', PASSWORD_DEFAULT ),
                'rank'              => 1,
                'erp'               => '1',
                'company_name'      => 'Benefitshop Corp.'
            ],
            [
                'id'                => 2,
                'email'             => 'kierownik_sektora@benefitshop.pl',
                'password'          => password_hash( 'zxc', PASSWORD_DEFAULT ),
                'rank'              => 2,
                'erp'               => '2',
                'company_name'      => 'Benefitshop Corp.'
            ],
            [
                'id'                => 3,
                'email'             => 'kierownik_regionu@benefitshop.pl',
                'password'          => password_hash( 'zxc', PASSWORD_DEFAULT ),
                'rank'              => 3,
                'erp'               => '3',
                'company_name'      => 'Benefitshop Corp.'
            ],
            [
                'id'                => 4,
                'email'             => 'dystrybutor@benefitshop.pl',
                'password'          => password_hash( 'zxc', PASSWORD_DEFAULT ),
                'rank'              => 4,
                'erp'               => '4',
                'company_name'      => 'Benefitshop Corp.'
            ]
        ];

        $this->db->table('user')->insertBatch( array_merge( $data, $this->generate_fake_user( 100 ) ) );
    }

    private function generate_fake_user( int $quantity = 1 ): array
    {
        $faker = Factory::create();
        helper('text');

        $id_iterator = 4;
        $fake_data = [];
        for( $q = 0; $q < $quantity; $q++ ) :
            $id_iterator++;
            $fake_data[] = [
                'id'                => $id_iterator,
                'email'             => $faker->email,
                'password'          => password_hash( 'zxc', PASSWORD_DEFAULT ),
                'rank'              => rand( 2, 4 ),
                'erp'               => random_string(),
                'company_name'      => $faker->company
            ];
        endfor;

        return $fake_data;
    }
}
