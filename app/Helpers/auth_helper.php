<?php
if ( !function_exists('isLoggedIn') ) :
    function isLoggedIn(): bool
    {
        return !empty( session()->user );
    }
endif;

if ( !function_exists('isAdmin') ) :
    function isAdmin(): bool
    {
        if( empty( $user_session_data = session()->user ) )
            return false;

        return ADMIN_RANK_ID === (int)$user_session_data['rank'];
    }
endif;