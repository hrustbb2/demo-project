<?php

namespace App\Models\JsonObjects;

use App\Models\Interfaces\JsonObjects\ISeoOptions;
use Src\Common\Dto\Object\AbstractComposite;
use Src\Common\Dto\Object\StringObject;
use Src\Common\Dto\Object\TextObject;

class SeoOptions extends AbstractComposite implements ISeoOptions {

    const TYPE = 'seo-options';

    public function init(): void
    {
        $this->type = self::TYPE;
        $this->setDescriptionStr('Seo options');

        $title = $this->fieldsFactory->createObjectField(AbstractComposite::STRING_TYPE);
        $title->setDescriptionStr('title');
        $this->fields['title'] = $title;

        $description = $this->fieldsFactory->createObjectField(AbstractComposite::TEXT_TYPE);
        $description->setDescriptionStr('Description');
        $this->fields['description'] = $description;
    }

    public function getTitle(): string
    {
        /** @var StringObject $field */
        $field = $this->fields['title'];
        return $field->getValue() ?? '';
    }

    public function getDescription(): string
    {
        /** @var TextObject $field */
        $field = $this->fields['description'];
        return $field->getValue() ?? '';
    }

}