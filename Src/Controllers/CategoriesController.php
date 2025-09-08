<?php

namespace Src\Controllers;


use Src\Models\Categories\Category;
use Src\Models\Products\Product;

use Src\Exceptions\InvalidArgumentException;
use Src\Exceptions\NotFoundException;
use Src\Exceptions\UnauthorizedException;
use Src\Exceptions\ForbiddenException;


class CategoriesController extends Controller
{
    public function all()
    {
        $categories = Category::getFirstLevelCategories();

        $this->view->renderHtml('Categories/all.php', ['categories' => $categories]);

    }
    public function view(int $articleId)
    {
        $category = Category::getById($articleId);
        if($category === null){
            throw new NotFoundException();
        }
        $breadcrumbs = $category->getBreadcrumbs();
        array_pop($breadcrumbs);
        $subCategories = $category->getSubCategories();
        $products = Product::getByCategory($category->getId());

        $this->view->renderHtml('Categories/view.php', ['category' => $category, 'breadcrumbs' => $breadcrumbs, 'subCategories' => $subCategories, 'products' => $products]);
    }
    public function add():void{
        $categories = [];
        $parentId = (int) ($_GET['id'] ?? '');
        if($this->user === null){
            throw new UnauthorizedException();
        }

        if($this->user->getRole() !== 'admin'){
            throw new ForbiddenException();
        }

        if(!empty($_POST)){
            try {
                $category = Category::createCategory($_POST);
            }catch (InvalidArgumentException $e){
                $categories = Category::getCategoriesWithoutProducts();
                $this->view->renderHtml('Categories/add.php', ['error' => $e->getMessage(), 'categories' => $categories, 'parentId' => $id]);
                return;
            }
            header("Location: {$this->baseDir}categories/" . $category->getId(), true, 302);
            exit();
        }
        $categories = Category::getCategoriesWithoutProducts();
        $this->view->renderHtml('Categories/add.php', ['categories' => $categories, 'parentId' => $parentId]);
    }
    public function search():void
    {
        if(empty($_GET['q'])){
            $this->view->renderHtml('Categories/search.php');
            return;
        }else{
            $products = Product::search($_GET['q']);
            $this->view->renderHtml('Categories/search.php',['products' => $products]);
        }
    }
}
