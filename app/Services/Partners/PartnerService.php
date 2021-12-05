<?php


namespace App\Services\Partners;


use App\Repository\PartnerRepository;
use Illuminate\Support\Collection;

class PartnerService implements IPartnerService
{
    private PartnerRepository $partnerRepository;

    public function __construct()
    {
        $this->partnerRepository = resolve(PartnerRepository::class);
    }

    public function getPartners(): Collection
    {
        return $this->partnerRepository->getAll();
    }
}
