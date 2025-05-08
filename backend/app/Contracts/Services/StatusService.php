<?php

namespace App\Contracts\Services;

use App\Models\Status;

interface StatusService
{
    public function getByCode(string $code): ?Status;
}
