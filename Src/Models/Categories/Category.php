<?php

namespace Src\Models\Categories;

use Src\Models\ActiveRecordEntity;




class Category extends ActiveRecordEntity
{
    protected $title;
    protected $parentId;
    protected $price;
    protected $description;
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getParentId(): string
    {
        return $this->parentId;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public static function getTableName(): string
    {
        return 'categories';
    }
}