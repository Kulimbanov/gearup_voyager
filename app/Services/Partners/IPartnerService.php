<?php

namespace App\Services\Partners;

use Illuminate\Support\Collection;

interface IPartnerService
{
    public function getPartners(): Collection;
}
