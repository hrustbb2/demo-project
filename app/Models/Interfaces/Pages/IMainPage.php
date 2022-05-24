<?php

namespace App\Models\Interfaces\Pages;

use Src\Modules\JsonObjects\Interfaces\Infrastructure\IItemStorage as IJsonObjItemsStorage;
use Src\Modules\JsonObjects\Interfaces\Dto\Item\IFactory as IJsonObjectsDtoFactory;
use App\Models\Interfaces\JsonObjects\IMainPageOptions;

interface IMainPage
{
    public function setJsonObjStorage(IJsonObjItemsStorage $storage): void;
    public function setJsonObjDtoFactory(IJsonObjectsDtoFactory $factory): void;
    public function init(): void;
    public function getPageOptions(): IMainPageOptions;
}
