<?php

namespace App\DTO\Auth;

use App\DTO\ApiResponseDto;
use App\DTO\Page\PublicPageDto;
use App\Providers\RouteServiceProvider;
use App\Services\Page\Generator\IPublicPageService;
use App\Traits\Jsonable;
use JsonSerializable;

class EmailVerifyResponseDto extends PublicPageDto implements JsonSerializable
{
    use Jsonable;

    private ?ApiResponseDto $api;
    //private ?PublicPageDto $page;

    public function __construct(PublicPageDto $publicPageDto)
    {
        $this->title = $publicPageDto->getTitle();
        $this->subTitle = $publicPageDto->getSubTitle();
        $this->body = $publicPageDto->getBody();
        $this->headerImage = $publicPageDto->getHeaderImage();
        $this->template = $publicPageDto->getTemplate();
        $this->apiResponseDto = new ApiResponseDto();
    }

    public function getApiResponseDto(): ?ApiResponseDto
    {
        return $this->api;
    }

    public function setApiResponseDto(?ApiResponseDto $apiResponseDto): self
    {
        $this->apiResponseDto = $apiResponseDto;

        return $this;
    }

    //public function getPublicPageDto(): ?PublicPageDto
    //{
    //    return $this->page;
    //}
    //
    //public function setPublicPageDto(?PublicPageDto $publicPageDto): self
    //{
    //    $this->publicPageDto = $publicPageDto;
    //
    //    return $this;
    //}
}
