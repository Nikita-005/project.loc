<?php

namespace Src\Models\Products;

use Src\Models\ActiveRecordEntity;
use Src\Models\Users\User;
use Src\Exceptions\InvalidArgumentException;



class Product extends ActiveRecordEntity
{
    protected $title;
    protected $content;
    protected $price;
    protected $oldPrice;
    protected $description;
    protected $img;
    protected $isOffer;
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getContent(): string
    {
        return $this->content;
    }
    public function getPrice(): string
    {
        return $this->price;
    }
    public function getOldPrice(): string
    {
        return $this->oldPrice;
    }
    public function getImg(): string
    {
        return $this->img;
    }
    public function getIsOffer(): string
    {
        return $this->isOffer;
    }
    public static function getByCategory(string $categoryId): ?array
    {
        return parent::findByColumn('category_id', $categoryId);
    }
    public static function getTableName(): string
    {
        return 'products';
    }
}