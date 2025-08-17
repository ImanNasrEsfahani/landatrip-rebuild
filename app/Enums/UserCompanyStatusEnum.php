<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Working()
 * @method static static Completed()
 */
final class UserCompanyStatusEnum extends Enum
{
    const working   = 0;
    const completed = 1;

    public static function getDescription(mixed $value): string
    {
        return match ($value) {
            self::working => 'Working',
            self::completed => 'Completed',
            default => self::getKey($value),
        };
    }
}
