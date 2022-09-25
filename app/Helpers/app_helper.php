<?php

if ( !function_exists('get_table_params') ) :
    function get_table_params( CodeIgniter\HTTP\CLIRequest|CodeIgniter\HTTP\IncomingRequest $request ): array
    {
        return [
            $request->getGet('search') ?? '',
            $request->getGet('order_by') ?? '',
            empty($request->getGet('reversed')) ? 'ASC' : 'DESC',
        ];
    }
endif;

if ( !function_exists('prepare_table_params') ) :
    function prepare_table_params( string $searchValue, string $headers_template, array $list, \CodeIgniter\Pager\Pager $pager ): array
    {
        helper('table_headers/' . $headers_template );

        return [
            'search_value'      => $searchValue,
            'pager'             => $pager,
            'data'              => get_table_formatted_data( $list ),
            'headers'           => get_table_headers(),
        ];
    }
endif;