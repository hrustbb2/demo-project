<?php

namespace App\Models\Interfaces;

use App\Models\Interfaces\Pages\IFactory as IPagesFactory;
use Src\ModulesProvider;

interface IFactory {
    public function getPagesFactory(): IPagesFactory;
    public function getModulesProvider(): ModulesProvider;
}