<?php

namespace App\Models\Pages;

use App\Models\Interfaces\Pages\IMainPage;
use Src\Modules\JsonObjects\Interfaces\Infrastructure\IItemStorage as IJsonObjItemsStorage;
use Src\Modules\JsonObjects\Interfaces\Dto\Item\IFactory as IJsonObjectsDtoFactory;
use App\Models\Interfaces\JsonObjects\IMainPageOptions;
use App\Models\JsonObjects\MainPageOptions;

class MainPage implements IMainPage
{

    protected IJsonObjItemsStorage $jsonObjStorage;

    protected IJsonObjectsDtoFactory $jsonObjDtoFactory;

    protected IMainPageOptions $mainPageOptions;

    public function setJsonObjStorage(IJsonObjItemsStorage $storage): void
    {
        $this->jsonObjStorage = $storage;
    }

    public function setJsonObjDtoFactory(IJsonObjectsDtoFactory $factory): void
    {
        $this->jsonObjDtoFactory = $factory;
    }

    public function init(): void
    {
        $mainPageData = $this->jsonObjStorage->getByKey('main_page_options');
        $mainPageItemObj = $this->jsonObjDtoFactory->createResource();
        $mainPageItemObj->load($mainPageData);

        $this->mainPageOptions = $mainPageItemObj->getObject();
    }

    public function getPageOptions(): MainPageOptions
    {
        return $this->mainPageOptions;
    }

}
