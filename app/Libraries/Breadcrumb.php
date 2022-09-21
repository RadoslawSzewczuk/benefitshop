<?php

namespace App\Libraries;

class Breadcrumb
{
    private mixed $URI;

    public function __construct()
    {
        $this->URI = service('uri');
    }

    public function build(): string
    {
        return '';
    }
}