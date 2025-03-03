<?php

namespace Src\Controllers;
use Src\Views\View;

class MainController extends Controller
{

    public function main()
    {
        $this->view->renderHtml('Main/main.php');
    }

    public function sayHello(string $name){
        $content = 'Привет, '.$name;
        include __DIR__.'/../Views/Layouts/default.php';
    }
}