<?php
declare(strict_types = 1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PrivacyPolicyEnum extends Enum
{
    const Public        = 0;
    const followersOnly = 1;

    const private       = 2;

    public static function getDescription(mixed $value): string
    {
        return match ($value) {
            self::Public => 'Public',
            self::followersOnly => 'Followers Only',
            self::private => 'Private',
            default => self::getKey($value),
        };
    }
}
