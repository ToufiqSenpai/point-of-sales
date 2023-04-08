<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'ADMIN';
    case OWNER = 'OWNER';
    case CASHIER = 'CASHIER';
}
