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
                'title'         => 'Orders',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/orders',
                'active'        => 1,
            ],
            [
                'id'            => 2,
                'title'         => 'Users',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/users',
                'active'        => 1,
            ],
            [
                'id'            => 3,
                'title'         => 'Product catalogue',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/product_catalogue',
                'active'        => 1,
            ],
            [
                'id'            => 4,
                'title'         => 'Send e-mail',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/send_email',
                'active'        => 1,
            ],
            [
                'id'            => 5,
                'title'         => 'Settings',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/settings',
                'active'        => 1,
            ],
            [
                'id'            => 6,
                'title'         => 'Import wallets',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/import_wallets',
                'active'        => 1,
            ],
            [
                'id'            => 7,
                'title'         => 'Raports',
                'icon'          => '',
                'roles'         => ADMIN_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'admin/raports',
                'active'        => 1,
            ],

            [
                'id'            => 8,
                'title'         => 'Desktop',
                'icon'          => '',
                'roles'         => SECTOR_MANAGER_RANK_ID . ', ' . REGION_MANAGER_RANK_ID . ', ' . DISTRIBUTOR_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'user/desktop',
                'active'        => 1,
            ],
            [
                'id'            => 9,
                'title'         => 'Products',
                'icon'          => '',
                'roles'         => SECTOR_MANAGER_RANK_ID . ', ' . REGION_MANAGER_RANK_ID . ', ' . DISTRIBUTOR_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'user/products',
                'active'        => 1,
            ],
            [
                'id'            => 10,
                'title'         => 'Orders history',
                'icon'          => '',
                'roles'         => SECTOR_MANAGER_RANK_ID . ', ' . REGION_MANAGER_RANK_ID . ', ' . DISTRIBUTOR_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'user/order_history',
                'active'        => 1,
            ],
            [
                'id'            => 11,
                'title'         => 'Wallet',
                'icon'          => '',
                'roles'         => SECTOR_MANAGER_RANK_ID . ', ' . REGION_MANAGER_RANK_ID . ', ' . DISTRIBUTOR_RANK_ID,
                'logged_only'   => 1,
                'route'         => 'user/wallet',
                'active'        => 1,
            ],
            [
                'id'            => 12,
                'title'         => 'Distributors',
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
