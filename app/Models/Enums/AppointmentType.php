<?php

namespace App\Models\Enums;

use Illuminate\Contracts\Support\DeferringDisplayableValue;

enum AppointmentType: int implements DeferringDisplayableValue
{
    case REVIEW = 1;
    case CHANGE_OF_SPECTACLES = 2;

    public function isReview(): bool
    {
        return $this == self::REVIEW;
    }

    public function isChangeOfSpecies(): bool
    {
        return $this == self::CHANGE_OF_SPECTACLES;
    }

    public function resolveDisplayableValue(): string
    {
        return match (true) {
            $this->isReview()   => 'Review',
            $this->isChangeOfSpecies() => 'Change of Spectacles'
        };
    }
}
