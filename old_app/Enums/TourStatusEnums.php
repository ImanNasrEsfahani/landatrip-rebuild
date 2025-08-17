<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Pending()
 * @method static static Approved()
 * @method static static Rejected()
 * @method static static Suspended()
 */
final class TourStatusEnums extends Enum implements LocalizedEnum
{
    const draft = 0;

    const pending = 1;
    const approved = 2;

    const rejected = 3;
    const suspended = 4;

    public static function getDescription(mixed $value): string
    {
        return match ($value) {
            self::draft => 'Draft',
            self::pending => 'Pending',
            self::approved => 'Approved',
            self::rejected => 'Rejected',
            self::suspended => 'Suspended',
            default => self::getKey($value),
        };
    }
}
