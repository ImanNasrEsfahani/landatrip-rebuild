<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TourEvaluationEnum extends Enum
{
    const noEvaluation     = 0;
    const finalInterview    = 1;
    const paperBased        = 2;

    const project           = 3;

    public static function getDescription(mixed $value): string
    {
        return match ($value) {
            self::noEvaluation => 'No Evaluation',
            self::finalInterview => 'Final Interview',
            self::paperBased => 'Paper Based',
            self::project => 'Project',
            default => self::getKey($value),
        };
    }
}
