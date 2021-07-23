<?php

namespace App\Repository;

use App\Models\Repairment;

class RepairmentRepository
{
    public function getBySlug(string $slug): Repairment
    {
        return Repairment::where(Repairment::SLUG, $slug)->firstOrFail();
    }
}
