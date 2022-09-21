<?php

if ( !function_exists('get_table_params') ) {
    function get_table_params( CodeIgniter\HTTP\CLIRequest|CodeIgniter\HTTP\IncomingRequest $request ): array
    {
        return [
            $request->getGet('search') ?? '',
            $request->getGet('order_by') ?? '',
            empty($request->getGet('reversed')) ? 'ASC' : 'DESC',
        ];
    }
}

if ( !function_exists('prepare_table_params') ) {
    function prepare_table_params( string $searchValue, array $list, \CodeIgniter\Pager\Pager $pager ): array
    {
        return [
            'search_value'      => $searchValue,
            'pager'             => $pager,
            'data'              => $list,
            'headers'           => [
                [ 'title' => 'ID', 'sortable' => true, 'mapped_field' => 'id', ],
                [ 'title' => 'E-mail', 'sortable' => true, 'mapped_field' => 'email', ],
                [ 'title' => 'Nazwa', 'sortable' => true, 'mapped_field' => 'company_name', ],
                [ 'title' => 'Rola', 'sortable' => true, 'mapped_field' => 'title', ],
                [ 'title' => 'ERP ID', 'sortable' => true, 'mapped_field' => 'erp', ],
                [ 'title' => 'Status', 'sortable' => true, 'mapped_field' => 'status', ],
                [ 'title' => 'Akcje'],
            ],
        ];
    }
}