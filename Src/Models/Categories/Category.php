<?php

namespace Src\Models\Categories;

use Src\Models\ActiveRecordEntity;
use Src\Exceptions\InvalidArgumentException;



class Category extends ActiveRecordEntity
{
    protected $title;
    protected $parentId;
    protected $description;
    protected $catType;
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getParentId(): int
    {
        return $this->parentId;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getCatType(): string
    {
        return $this->catType;
    }
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    public function setDescription(string $description)
    {
        $this->title = $description;
    }
    public function setParentId(int $parentId)
    {
        $this->parentId = $parentId;
    }
    public function setCatType(string $catType)
    {
        $this->catType = $catType;
    }
    public static function getTableName(): string
    {
        return 'categories';
    }
    //Вариант с ключами
    // public static function getCategories( bool $associativeId = false): ?array
    // {
    //     $categories = self::findAll();
    //     if($associativeId) {
    //         $result = [];
    //         foreach($categories as $category){
    //             $result[$category->id] = $category;
    //         }
    //     }else{
    //         $result = $categories;
    //     }
    //     return $result;
    // }
    public static function getCategories() : ?array
    {
        return self::findAll();
    }
    public function getSubCategories(): ?array
    {
        return array_filter(self::getCategories(), function($elem){
            return $elem->getParentId() == $this->getId();
        } );
    }
    //Возвращает все категории, доступные для подкатегорий (категории, в которых нет продуктов)
    public static function getCategoriesWithoutProducts(): ?array
    {
        return array_filter(self::getCategories(), function($elem){
            return $elem->getCatType() !== "products";
        } );
    }
    //Возвращает все категории, доступные для продуктов (в которых нет подкатегорий)
    public static function getAvailableForProductCategories(): ?array
    {
        return array_filter(self::getCategories(), function($elem){
            return $elem->getCatType() !== "subcat";
        } );
    }

    public static function getFirstLevelCategories(): ?array
    {
        return array_filter(self::getCategories(), function($elem){
            return $elem->getParentId() == 0;
        } );
    }

    public static function createCategory(array $fields): Category
    {
        if(empty($fields['title'])){
            throw new InvalidArgumentException('Не передано наименование товара');
        }

        $category = new Category();


        $category->setTitle($fields['title']);
        $category->setParentId($fields['category'] ?? '0');
        $parentCategory = self::getById($category->getParentId());

        if($parentCategory ? $parentCategory->getCatType() == 'unknown' : 0){
            $parentCategory->setCatType('subcat');
            $parentCategory->save();
        }

        $category->save();

        return $category;

    }
    public function getBreadcrumbs(): ?array
    {
        $breadcrumbs =[];
        $category = $this;
        do{
            $breadcrumbs[] = $category;
            $category = self::getById($category->getParentId());
            $a=5;
        }
        while(isset($category));
        return !empty($breadcrumbs) ? array_reverse($breadcrumbs) : null;
    }
}