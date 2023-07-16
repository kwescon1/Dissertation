<?php

namespace App\Models\Enums;

use Illuminate\Contracts\Support\DeferringDisplayableValue;

enum AppointmentStatus: int implements DeferringDisplayableValue
{
    case SCHEDULED = 1;
    case IN_PROGRESS = 2;
    case COMPLETED = 3;
    case CANCELLED = 4;
    case NO_SHOW = 5;

    public function isScheduled(): bool
    {
        return $this == self::SCHEDULED;
    }

    public function isInProgress(): bool
    {
        return $this == self::IN_PROGRESS;
    }

    public function isCompleted(): bool
    {
        return $this == self::COMPLETED;
    }

    public function isCancelled(): bool
    {
        return $this == self::CANCELLED;
    }

    public function isNoShow(): bool
    {
        return $this == self::NO_SHOW;
    }

    public function resolveDisplayableValue(): string
    {
        return match (true) {
            $this->isScheduled()   => 'Scheduled',
            $this->isInProgress()   => 'In Progress',
            $this->isCompleted()   => 'Completed',
            $this->isCancelled()   => 'Cancelled',
            $this->isNoShow()   => 'Did Not Show',
        };
    }
}
