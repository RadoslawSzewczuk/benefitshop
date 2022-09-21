<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'            => 1,
                'title'         => 'Zamówienia',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/orders',
                'active'        => 1,
            ],
            [
                'id'            => 2,
                'title'         => 'Użytkownicy',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/users',
                'active'        => 1,
            ],
            [
                'id'            => 3,
                'title'         => 'Katalog produktów',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/product_catalogue',
                'active'        => 1,
            ],
            [
                'id'            => 4,
                'title'         => 'Wyślij e-mail',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/send_email',
                'active'        => 1,
            ],
            [
                'id'            => 5,
                'title'         => 'Ustawienia',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/settings',
                'active'        => 1,
            ],
            [
                'id'            => 6,
                'title'         => 'Importuj portfele',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/import_wallets',
                'active'        => 1,
            ],
            [
                'id'            => 7,
                'title'         => 'Raporty',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/raports',
                'active'        => 1,
            ],

            [
                'id'            => 8,
                'title'         => 'Pulpit',
                'icon'          => '',
                'roles'         => SECTOR_MANAGER_RANK_ID . ', ' . REGION_MANAGER_RANK_ID . ', ' . DISTRIBUTOR_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'user/desktop',
                'active'        => 1,
            ],
            [
                'id'            => 9,
                'title'         => 'Produkty',
                'icon'          => '',
                'roles'         => SECTOR_MANAGER_RANK_ID . ', ' . REGION_MANAGER_RANK_ID . ', ' . DISTRIBUTOR_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'user/products',
                'active'        => 1,
            ],
            [
                'id'            => 10,
                'title'         => 'Historia zamówień',
                'icon'          => '',
                'roles'         => SECTOR_MANAGER_RANK_ID . ', ' . REGION_MANAGER_RANK_ID . ', ' . DISTRIBUTOR_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'user/order_history',
                'active'        => 1,
            ],
            [
                'id'            => 11,
                'title'         => 'Portfel',
                'icon'          => '',
                'roles'         => SECTOR_MANAGER_RANK_ID . ', ' . REGION_MANAGER_RANK_ID . ', ' . DISTRIBUTOR_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'user/wallet',
                'active'        => 1,
            ],
            [
                'id'            => 12,
                'title'         => 'Dystrybutorzy',
                'icon'          => '',
                'roles'         => SECTOR_MANAGER_RANK_ID . ', ' . REGION_MANAGER_RANK_ID . ', ' . DISTRIBUTOR_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'user/distributors',
                'active'        => 1,
            ],
        ];

        $this->db->table('menu')->insertBatch( $data );
    }
}
