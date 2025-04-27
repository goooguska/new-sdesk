<?php

namespace App\Traits;

trait Authorized
{
    public function authorize(): bool
    {
        return true;
    }
}
