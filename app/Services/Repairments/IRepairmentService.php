<?php

namespace App\Services\Repairments;

use App\DTO\Repairment\RepairmentDto;

interface IRepairmentService
{
    public function getRepairmentBySlug(?string $slug): RepairmentDto;
}
