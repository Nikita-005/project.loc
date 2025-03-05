<?php

namespace Src\Controllers;


use Src\Models\Categories\Category;
use Src\Models\Products\Product;
use Src\Exceptions\NotFoundException;

class CategoriesController extends Controller
{
    public function all()
    {
        $categories = Category::findAll();

        $this->view->renderHtml('Categories/all.php', ['categories' => $categories]);

    }
    public function view(int $articleId)
    {
        $category = Category::getById($articleId);
        if($category === null){
            throw new NotFoundException();
        }
        $products = Product::getByCategory($category->getId());

        $this->view->renderHtml('Categories/view.php', ['category' => $category, 'products' => $products]);
    }
}
