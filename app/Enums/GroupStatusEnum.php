<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Completed()
 * @method static static SoldOut()
 * @method static static Canceled()
 * @method static static NoTime()
 * @method static static Upcoming()
 */
final class GroupStatusEnum extends Enum
{
    const draft   = 0;
    const preRegistration   = 1;
    const registration   = 2;
    const startSoon   = 3;
    const onGoing   = 4;
    const completed = 5;

    const soldOut   = 6;
    const canceled  = 7;

    public static function getDescription(mixed $value): string
    {
        return match ($value) {
            self::draft => 'Draft',
            self::preRegistration => 'Pre Registration',
            self::registration => 'Registration',
            self::startSoon => 'Start Soon',
            self::onGoing => 'On Going',
            self::completed => 'Completed',
            self::soldOut => 'Sold Out',
            self::canceled => 'Canceled',
            default => self::getKey($value),
        };
    }
}
