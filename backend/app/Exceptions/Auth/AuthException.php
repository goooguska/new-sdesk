<?php

namespace App\Exceptions\Auth;

use Exception;

class AuthException extends Exception
{
    protected $code = 500;
}
