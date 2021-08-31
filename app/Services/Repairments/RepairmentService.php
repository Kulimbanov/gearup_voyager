<?php

namespace App\Services\Repairments;

use App\DTO\Repairment\RepairmentDto;
use App\Repository\RepairmentRepository;

class RepairmentService implements IRepairmentService
{
    private RepairmentRepository $repairmentRepository;

    public function __construct(RepairmentRepository $repairmentRepository)
    {
        $this->repairmentRepository = $repairmentRepository;
    }

    public function getRepairmentBySlug(?string $slug): RepairmentDto
    {
        $repairment = $this->repairmentRepository->getBySlug($slug);

        return (new RepairmentDto)
            ->setId($repairment->id)
            ->setName($repairment->name)
            ->setSlug($repairment->slug)
            ->setDescription($repairment->description);
    }
}
