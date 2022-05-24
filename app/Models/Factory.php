<?php

namespace App\Models;

use App\Models\Interfaces\IFactory;
use Src\ModulesProvider;
use App\Providers\AppServiceProvider;
use App\Models\Interfaces\Pages\IFactory as IPagesFactory;
use App\Models\Pages\Factory as PagesFactory;

class Factory implements IFactory {

    protected ModulesProvider $modulesProvider;

    protected ?IPagesFactory $pagesFactory = null;

    public function __construct()
    {
        $this->modulesProvider = app()->get(AppServiceProvider::ADMIN_MODULES);
    }

    public function getModulesProvider(): ModulesProvider
    {
        return $this->modulesProvider;
    }

    public function getPagesFactory(): PagesFactory
    {
        if($this->pagesFactory === null){
            $this->pagesFactory = new PagesFactory();
            $this->pagesFactory->setModelsFactory($this);
        }
        return $this->pagesFactory;
    }

}