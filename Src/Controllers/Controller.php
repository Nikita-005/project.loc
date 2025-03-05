<?php
namespace Src\Controllers;

use Src\Views\View;
use Src\Models\Users\User;
use Src\Models\Users\UsersAuthService;

abstract class Controller
{
    protected $view;
    protected $user;
    protected $baseDir;
    protected $layout = "default";
    public function __construct()
    {
        $this->view = new View($this->layout);
        $this->user = UsersAuthService::getUserByToken();
        $this->view->setVar('user', $this->user);
        $this->baseDir = $GLOBALS['base_dir'];
    }

}