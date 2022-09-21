<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function test_views( $view_name ): string
    {
        return view('test_views/' . $view_name );
    }
}
