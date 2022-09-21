<?php

use App\Models\Menu;

if( !function_exists( 'get_sidebar_menu' ) ) :
    function get_sidebar_menu() : array
    {
        $menu_options = ( new Menu() )->where('active', 1)->findAll();
        $user_role = empty( session()->user ) ? 0 : session()->user['rank'];

        $menu_arr = [];
        foreach( $menu_options as $option ) :

            if( !empty( $option['logged_only'] ) && !isLoggedIn() )
                continue;

            if( !empty( $roles = explode(',', $option['roles'] ) ) && !in_array( $user_role, $roles ) )
                continue;

            $menu_arr[] = [
                'title'     => $option['title'],
                'icon'      => $option['icon'],
                'route'     => $option['route']
            ];
        endforeach;

        return $menu_arr;
    }
endif;