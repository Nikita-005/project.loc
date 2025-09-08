<?php

namespace Src\Models\Products;

use Src\Models\Categories\Category;
use Src\Models\ActiveRecordEntity;
use Src\Exceptions\InvalidArgumentException;
use Src\Exceptions\FileException;

use Src\Services\File;



class Product extends ActiveRecordEntity
{
    protected $categoryId;
    protected $title;
    protected $content;
    protected $price;
    protected $oldPrice;
    protected $description;
    protected $img;
    protected $isOffer;
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }
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
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    public function setContent(string $content)
    {
        $this->content = $content;
    }
    public function setPrice(string $price)
    {
        $this->price = $price;
    }
    public function setImg(string $img)
    {
        $this->img = $img;
    }
    public static function getByCategory(string $categoryId): ?array
    {
        return self::findByColumn('category_id', $categoryId);
    }
    public static function createProduct(array $fields): Product
    {
        if(empty($fields['title'])){
            throw new InvalidArgumentException('Не передано наименование товара');
        }
        if(empty($fields['content'])){
            throw new InvalidArgumentException('Не передано описание товара');
        }
        if(empty($fields['price'])){
            throw new InvalidArgumentException('Не передана цена товара');
        }
        if(empty($fields['category'] ||$fields['category']==0 )){
            throw new InvalidArgumentException('Не передана категория');
        }
        if(empty($fields['image_file']['name'] )){
            throw new InvalidArgumentException('Не передан файл');
        }
        //Проверка, что категория не предназначена для подкатегорий
        $category = Category::getById($fields['category']);

        if($category->getCatType() == 'subcat'){
            throw new InvalidArgumentException('В этой категории нельзя создать товар');
        }

        $product = new Product();


        $product->setTitle($fields['title']);
        $product->setContent($fields['content']);
        $product->setPrice((int)$fields['price']);
        $product->setCategoryId ((int)$fields['category']);
        $product->setImg ($fields['image_file']['name']);

        $newFilePath = __DIR__.'/../../../img/products/'.$product->getImg();

        //Проверка существования файла
        $newFilePath = File::checkFileName($newFilePath);
        $arrStr = explode('/',$newFilePath);
        $product->setImg ($arrStr[count($arrStr)-1]);

        if (!move_uploaded_file($fields['image_file']['tmp_name'], $newFilePath)) {
            throw new FileException("Ошибка при загрузке файла");
        }
        if($category->getCatType() == 'unknown'){
             $category->setCatType('products');
             $category->save();
        }

        $product->save();

        return $product;

    }
    public static function getTableName(): string
    {
        return 'products';
    }

}