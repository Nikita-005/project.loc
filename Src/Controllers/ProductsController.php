<?php

namespace Src\Controllers;

use Src\Exceptions\InvalidArgumentException;
use Src\Exceptions\NotFoundException;
use Src\Exceptions\UnauthorizedException;
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

        $this->view->renderHtml('Products/view.php', ['product' => $product]);
    }
}
