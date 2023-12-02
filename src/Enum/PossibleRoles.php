<?php

namespace App\Enum;

enum PossibleRoles: string {
    case User = 'USER_ROLE';
    case Creator = 'CREATOR_ROLE';
    case Admin = 'ADMIN_ROLE';
}