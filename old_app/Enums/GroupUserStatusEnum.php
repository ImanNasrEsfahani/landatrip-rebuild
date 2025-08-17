<?php
declare(strict_types = 1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Completed()
 * @method static static SoldOut()
 * @method static static Canceled()
 * @method static static NoTime()
 * @method static static Upcoming()
 */
final class GroupUserStatusEnum extends Enum
{
    const booked      = 0;
    const pending     = 1;
    const rejected    = 2;
    const canceled    = 3;
    const completed   = 4;
    const reservation = 5;

    public static function getDescription(mixed $value): string
    {
        return match ($value) {
            self::booked => 'Booking',
            self::pending => 'Pending',
            self::rejected => 'Rejected',
            self::canceled => 'Canceled',
            self::completed => 'Completed',
            self::reservation => 'Reservation',
            default => self::getKey($value),
        };
    }
}
