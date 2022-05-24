<?php

namespace App\Models\JsonObjects;

use Src\Common\Dto\Object\Factory;
use Src\Common\Dto\Object\AbstractObject;

class ObjFactory extends Factory {

    public function createObjectField(string $type): ?AbstractObject
    {
        $obj = parent::createObjectField($type);
        if($obj){
            return $obj;
        }
        if($type == SeoOptions::TYPE){
            $obj = new SeoOptions();
            $obj->setFieldsFactory($this);
            $obj->init();
        }
        if($type == MainPageOptions::TYPE){
            $obj = new MainPageOptions();
            $obj->setFieldsFactory($this);
            $obj->init();
        }
        return $obj;
    }

}