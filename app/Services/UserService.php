<?php

namespace App\Services;

class UserService
{
    public function formatName($name)
    {
        return strtoupper($name);
    }
}
