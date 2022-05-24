<?php

namespace App\Models\Pages;

use App\Models\Interfaces\IFactory as IModelsFactory;
use App\Models\Interfaces\Pages\IFactory;

class Factory implements IFactory
{
    protected IModelsFactory $modelsFactory;

    public function setModelsFactory(IModelsFactory $factory): void
    {
        $this->modelsFactory = $factory;
    }

    public function createMainPage(): MainPage
    {
        $page = new MainPage();
        $jsonStorage = $this->modelsFactory->getModulesProvider()->getJsonObjectsFactory()->getInfrastructureFactory()->getStorage();
        $page->setJsonObjStorage($jsonStorage);
        $jsonDtoFactory = $this->modelsFactory->getModulesProvider()->getJsonObjectsFactory()->getDtoFactory()->getItemFactory();
        $page->setJsonObjDtoFactory($jsonDtoFactory);
        $page->init();
        return $page;
    }
}
