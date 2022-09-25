<?php
if( !function_exists('get_table_headers') ) :
    function get_table_headers(): array
    {
        return [
            ['title' => 'Company',    'sortable' => true, 'mapped_field' => 'company_name',],
            ['title' => 'ID',       'sortable' => true, 'mapped_field' => 'id',],
            ['title' => 'E-mail',   'sortable' => true, 'mapped_field' => 'email',],
            ['title' => 'Role',     'sortable' => true, 'mapped_field' => 'title',],
            ['title' => 'ERP ID',   'sortable' => true, 'mapped_field' => 'erp',],
            ['title' => 'Status',   'sortable' => false, 'mapped_field' => 'status',],
            [
                'title'     => 'Actions',
                'type'      => 'actions',
                'actions'   => [
                    [
                        'tooltip'               => 'Edit',
                        'icon'                  => 'edit-icon',
                        'additional-class'      => 'edit-user',
                        'data-params'           => [
                            [ 'title'         => 'id', 'mapped_field'  => 'id', ]
                        ]
                    ],
                    [
                        'tooltip'               => 'Wallet',
                        'icon'                  => 'wallet-icon',
                        'additional-class'      => 'show-user-wallet',
                        'data-params'           => [
                            [ 'title'         => 'id', 'mapped_field'  => 'id', ]
                        ]
                    ],
                    [
                        'tooltip'               => 'Block',
                        'mods'                  => [
                            'type'  => 'switch',
                            'data'  => [
                                'mapped_field'  => 'status',
                                'state'         => [
                                    [
                                        'tooltip'   => 'Block',
                                        'value'     => 'Active',
                                        'icon'      => 'block-icon',
                                        'url'       => base_url('admin/user/toggle') . '/{id}',
                                    ],
                                    [
                                        'tooltip'   => 'Unblock',
                                        'value'     => 'Inactive',
                                        'icon'      => 'unblock-icon',
                                        'url'       => base_url('admin/user/toggle') . '/{id}',
                                    ]
                                ]
                            ]
                        ],
                    ]
                ]
            ],
        ];
    }
endif;

if( !function_exists('get_table_formatted_data') ):
    function get_table_formatted_data( $list ) : array
    {
        $formatted_list = [];
        foreach( $list ?? [] as $item ) :
            $formatted_list[] = $item;
        endforeach;

        return $formatted_list;
    }
endif;
