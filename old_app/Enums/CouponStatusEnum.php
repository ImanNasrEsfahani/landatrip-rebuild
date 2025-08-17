<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static active()
 * @method static static used()
 * @method static static expired()
 */
final class CouponStatusEnum extends Enum
{
    const active  = 0;
    const used    = 1;
    const expired = 2;

    public static function getDescription(mixed $value): string
    {
        return match ($value) {
            self::active => 'Active',
            self::used => 'Used',
            self::expired => 'Expired',
            default => self::getKey($value),
        };
    }
}
