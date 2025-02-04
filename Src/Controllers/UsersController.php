<?php
namespace Src\Controllers;
use Src\Views\View;
use Src\Models\Users\User;
class UsersController
{
    private $view;
    private $layout = "default";
    public function __construct()
    {
        $this->view = new View($this->layout);
    }
    public function signUp()
    {
        if(!empty($_POST)){
            $user = User::signUp($_POST);
        }
        $this->view->renderHtml('Users/signUp.php');

    }
}