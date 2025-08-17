<?php
declare(strict_types = 1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProviderEnum extends Enum
{
    const landatrip = 0;
    const google    = 1;
    const facebook  = 2;
    const apple  = 2;

    public static function getDescription(mixed $value): string
    {
        return match ($value) {
            self::landatrip => 'Landa Trip',
            self::google => 'Google',
            self::facebook => 'Facebook',
            self::apple => 'Apple',
            default => self::getKey($value),
        };
    }
}
