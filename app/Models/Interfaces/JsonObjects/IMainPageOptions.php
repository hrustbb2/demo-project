<?php

namespace App\Models\Interfaces\JsonObjects;

interface IMainPageOptions
{
    public function getSeoOptions(): ISeoOptions;
    public function getHeaderPictureSrc(): string;
    public function getHeaderLabel(): string;
    public function getPageHeader():string;
    public function getPageSmallText():string;
}
