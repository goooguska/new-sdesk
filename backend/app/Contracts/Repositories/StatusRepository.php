<?php

namespace App\Contracts\Repositories;

use App\Models\Status;

interface StatusRepository
{
    public function getByCode(string $code): ?Status;
}
