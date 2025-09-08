<?php

namespace Src\Controllers;

use Src\Exceptions\InvalidArgumentException;
use Src\Exceptions\NotFoundException;
use Src\Exceptions\UnauthorizedException;
use Src\Exceptions\ForbiddenException;
use Src\Models\Categories\Category;
use Src\Models\Products\Product;


class ProductsController extends Controller
{
    public function all()
    {
        $products = Product::findAll();

        $this->view->renderHtml('Products/all.php', ['products' => $products]);

    }
    public function view(int $articleId)
    {
        $product = Product::getById($articleId);
        if($product === null){
            throw new NotFoundException();
        }
        $category = Category::getById($product->getCategoryId());
        $breadcrumbs = $category->getBreadcrumbs();
        $this->view->renderHtml('Products/view.php', ['product' => $product, 'breadcrumbs'=>$breadcrumbs]);
    }
    public function add():void{
        $categories = Category::findAll();

        $categoryId = (int) ($_POST['category'] ?? $_GET['id'] ?? 0);
        if($this->user === null){
            throw new UnauthorizedException();
        }

        if($this->user->getRole() !== 'admin'){
            throw new ForbiddenException();
        }

        if(!empty($_POST)){
            try {
                $product = Product::createProduct(array_merge($_POST, $_FILES));
            }catch (\Exception $e){
                // $categories = Category::getAvailableForProductCategories();
                $this->view->renderHtml('Products/add.php', ['error' => $e->getMessage(), 'categories' => $categories, 'categoryId' => $categoryId]);
                return;
            }

            header("Location: {$this->baseDir}products/" . $product->getId(), true, 302);
            exit();
        }
        // $categories = Category::getAvailableForProductCategories();
        $this->view->renderHtml('Products/add.php', ['categories' => $categories, 'categoryId' => $categoryId]);
    }
    public function add1():void{
        $categories = Category::findAll();
                if($this->user === null){
                    throw new UnauthorizedException();
                }
                if(!empty($_POST)){
                    try {
                        $product = Product::createProduct(array_merge($_POST, $_FILES));
                    }catch (\Exception $e){
                $this->view->renderHtml('Products/add.php', ['error' => $e->getMessage(), 'categories' => $categories]);
                return;
                }
                header("Location: /project.loc/products/".$product->getId(), true, 302);
                exit();
            }
        
            $this->view->renderHtml('Products/add.php', ['categories' => $categories]);
        }
}
