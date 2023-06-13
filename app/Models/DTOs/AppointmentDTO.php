<?php

namespace App\Models\DTOs;

use App\Models\Enums\AppointmentStatus;

readonly class AppointmentDTO
{
    private string $facilityBranchId;
    private string $clientId;
    private string $scheduledAt;
    private ?string $media;
    private ?string $notes;
    private mixed $type;
    private ?AppointmentStatus $status;

    public function __construct($facilityBranchId, $clientId, $scheduledAt, $media, $notes, $type, ?AppointmentStatus $status)
    {
        $this->facilityBranchId = $facilityBranchId;
        $this->clientId = $clientId;
        $this->scheduledAt = $scheduledAt;
        $this->media = $media;
        $this->notes = $notes;
        $this->type = $type;
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'facility_branch_id' => $this->facilityBranchId,
            'client_id' => $this->clientId,
            'scheduled_at' => $this->scheduledAt,
            'image' => $this->media,
            'notes' => $this->notes,
            'type' => $this->type,
            'status' => $this->status
        ];
    }
}
