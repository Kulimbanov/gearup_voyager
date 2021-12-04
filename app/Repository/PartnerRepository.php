<?php

namespace App\Repository;

use App\Models\Partner;
use Illuminate\Support\Collection;

class PartnerRepository
{
    public function getAll(): Collection
    {
        return Partner::all();
    }

}
