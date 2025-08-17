<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Completed()
 * @method static static Rejected()
 */
final class CertificationStatusEnum extends Enum
{
    const pending = 0;

    const completed = 1;
    const rejected = 2;

    public static function getDescription(mixed $value): string
    {
        return match ($value) {
            self::pending => 'Pending',
            self::completed => 'Completed',
            self::rejected => 'Rejected',
            default => self::getKey($value),
        };
    }
}
