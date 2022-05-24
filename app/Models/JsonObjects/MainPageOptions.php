<?php

namespace App\Models\JsonObjects;

use App\Models\Interfaces\JsonObjects\IMainPageOptions;
use Src\Common\Dto\Object\AbstractComposite;
use Intervention\Image\ImageManager;

class MainPageOptions extends AbstractComposite implements IMainPageOptions
{

    const TYPE = 'main-page-options';

    public function init(): void
    {
        $this->type = self::TYPE;
        $this->setDescriptionStr('Main page options');

        $seoOptions = $this->fieldsFactory->createObjectField(SeoOptions::TYPE);
        $seoOptions->setDescriptionStr('Seo options');
        $this->fields['seo_options'] = $seoOptions;

        // Изображение на странице
        /** @var ImageObject $headerPicture */
        $headerPicture = $this->fieldsFactory->createObjectField(self::IMAGE_TYPE);
        $headerPicture->setDescriptionStr('Header picture');
        $headerPicture->setPath('/uploads');
        $headerPicture->setAR(729 / 800);
        $this->fields['header_picture'] = $headerPicture;

        // Текст на картинке на странице
        $headerLabel = $this->fieldsFactory->createObjectField(self::STRING_TYPE);
        $headerLabel->setDescriptionStr('Header label');
        $this->fields['header_label'] = $headerLabel;

        // Заголовок
        $pageHeader = $this->fieldsFactory->createObjectField(self::STRING_TYPE);
        $pageHeader->setDescriptionStr('Page header');
        $this->fields['page_header'] = $pageHeader;

        // Текст под заголовком
        $pageSmallText = $this->fieldsFactory->createObjectField(self::STRING_TYPE);
        $pageSmallText->setDescriptionStr('Page Small Text');
        $this->fields['page_small_text'] = $pageSmallText;
    }

    public function getSeoOptions(): SeoOptions
    {
        return $this->fields['seo_options'];
    }

    public function getHeaderLabel(): string
    {
        /** @var StringObject $field */
        $field = $this->fields['header_label'];
        return $field->getValue() ?? '';
    }

    public function getPageHeader():string
    {
        /** @var StringObject $field */
        $field = $this->fields['page_header'];
        return $field->getValue() ?? '';
    }

    public function getPageSmallText():string
    {
        /** @var StringObject $field */
        $field = $this->fields['page_small_text'];
        return $field->getValue() ?? '';
    }

    protected function getHeaderPictureFileName(): string
    {
        /** @var ImageObject $field */
        $field = $this->fields['header_picture'];
        return $field->getValue() ?? '';
    }

    public function onSave(): void
    {
        // Ресайзим изображение при сохранении объекта
        if($this->getHeaderPictureFileName()){
            $this->saveResized(729, 800, '/uploads' . $this->getHeaderPictureFileName());
        }
    }

    protected function saveResized(int $width, int $height, string $fileName)
    {
        $filePath = storage_path() . $fileName;
        $img = (new ImageManager());
        $img = $img->make($filePath);
        $ar = $img->getWidth() / $img->getHeight();
        if($ar > $width / $height) {
            $resizedImg = $img->resize($img->getWidth() * ($height / $img->getHeight()), $height);
        }else{
            $resizedImg = $img->resize($width, $img->getHeight() * ($width / $img->getWidth()));
        }
        $croppedImg = $resizedImg->crop($width, $height);
        $storagePath = storage_path() . '/uploads/resized/';
        $croppedImg->save($storagePath . '/' . $width . '_' . $height . '_' . basename($fileName));
    }

    public function getHeaderPictureSrc(): string
    {
        return '/uploads/resized/729_800_' . trim($this->getHeaderPictureFileName(), '/');
    }
}
