<?php

namespace App\Enums\Users;

use App\Traits\Enums\BaseEnum;

enum RoleEnum: int
{
    use BaseEnum;

    case conceptor = 1;
    case admin     = 2;
    case visitor   = 99;

    /**
     * Optionnal labels definition
     */
    private const LABELS = [
        self::conceptor->name => 'enums.user-role.conceptor',
        self::admin->name     => 'enums.user-role.admin',
        self::visitor->name   => 'enums.user-role.visitor',
    ];
}
