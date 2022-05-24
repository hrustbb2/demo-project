<?php

namespace App\Models\Interfaces\Pages;

use App\Models\Interfaces\IFactory as IModelsFactory;
use App\Models\Interfaces\Pages\IMainPage;

interface IFactory
{
    public function setModelsFactory(IModelsFactory $factory): void;
    public function createMainPage(): IMainPage;
}
