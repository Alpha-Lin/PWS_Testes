<?php

namespace App\Enum;

enum PossibleRoles: string {
    case User = 'USER_ROLE';
    case SuperAdmin = 'SUPER_ADMIN_ROLE';
    case Creator = 'CREATOR_ROLE';
    case Admin = 'ADMIN_ROLE';
}