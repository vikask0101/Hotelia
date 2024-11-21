<?php

namespace App\Enum;

enum UserTypeEnum: int
{
    case ADMIN = 1;
    case REGULAR_USER = 0;
}
