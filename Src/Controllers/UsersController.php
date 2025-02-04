<?php
namespace Src\Controllers;
use Src\Exceptions\InvalidArgumentException;
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
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('Users/signUp.php',['error'=>$e->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('Users/signUp.php');

    }
}