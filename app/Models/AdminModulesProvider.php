<?php

namespace App\Models;

use Src\ModulesProvider;
use Src\Modules\JsonObjects\Interfaces\IFactory as IJSONFactory;
use Src\Modules\JsonObjects\Factory as JSONFactory;

class AdminModulesProvider extends ModulesProvider {

    public function getJsonObjectsFactory(): JSONFactory
    {
        if($this->jsonFactory === null){
            $this->jsonFactory = new JSONFactory();
            $this->jsonFactory->init();
            $objFactory = new \App\Models\JsonObjects\ObjFactory();
            $this->jsonFactory->loadSettings([
                IJSONFactory::DB_CHARSET => 'utf8',
                IJSONFactory::DB_HOST => 'db',
                IJSONFactory::DB_NAME => 'dbname',
                IJSONFactory::DB_PASS => 'password',
                IJSONFactory::DB_USER => 'user',
                IJSONFactory::ITEMS_DROPDOWN => [
                    [
                        IJSONFactory::ITEM_TITLE => 'Main page options',
                        IJSONFactory::ITEM_TYPE => \App\Models\JsonObjects\MainPageOptions::TYPE,
                    ]
                ],
                IJSONFactory::OBJECTS_FACTORY => $objFactory,
                IJSONFactory::OBJECTS_TABLE => 'json_obj_items',
                IJSONFactory::DIRS_TABLE => 'json_obj_dirs',
            ]);
            $dirTreeFactory = $this->createDirTreeFactory($this->jsonFactory->getSetting(IJSONFactory::DIRS_TABLE));
            $this->jsonFactory->setDirsTreeFactory($dirTreeFactory);
            $this->jsonFactory->injectModules($this);
        }
        return $this->jsonFactory;
    }

}