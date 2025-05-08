<?php

namespace App\Enums;

enum StatusEnum: string
{
    case DONE = 'done';

    case WORK = 'work';

    case REJECTED = 'rejected';
}
