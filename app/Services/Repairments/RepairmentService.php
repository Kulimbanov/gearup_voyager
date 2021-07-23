<?php

namespace App\Services\Repairments;

use App\DTO\Repairment\RepairmentDto;
use App\Repository\RepairmentRepository;

class RepairmentService implements IRepairmentService
{
    private RepairmentRepository $repairmentRepository;

    public function __construct()
    {
        $this->repairmentRepository = resolve(RepairmentRepository::class);
    }

    public function getRepairmentBySlug(?string $slug): RepairmentDto
    {
        $model = $this->repairmentRepository->getBySlug($slug);

        return (new RepairmentDto)
            ->setId($model->id)
            ->setName($model->name)
            ->setSlug($model->slug)
            ->setDescription($model->description);
    }
}
