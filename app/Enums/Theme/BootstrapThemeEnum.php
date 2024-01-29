<?php

namespace App\Enums\Theme;

use App\Traits\Enums\BaseEnum;

enum BootstrapThemeEnum: int
{
    use BaseEnum;

    case light = 1;
    case dark  = 2;

    /**
     * Optionnal labels definition.
     *
     * @phpstan-ignore-next-line
     */
    private const LABELS = [
        self::light->name => 'enums.bootstrap-theme.light',
        self::dark->name  => 'enums.bootstrap-theme.dark',
    ];
}
