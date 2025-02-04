<?php

namespace Src\Controllers;
use Src\Views\View;
use Src\Services\Db;
class MainController
{
    private $view;
    private $layout = 'default';

    private $db;

    public function __construct()
    {
        $this->view = new View($this->layout);
    }
    public function main()
    {
        $this->view->renderHtml('Main/main.php');
    }

    public function sayHello(string $name){
        $content = 'Привет, '.$name;
        include __DIR__.'/../Views/Layouts/default.php';
    }
}