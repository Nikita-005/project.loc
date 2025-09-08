<?php

namespace Src\Controllers;

use Src\Exceptions\InvalidArgumentException;
use Src\Exceptions\NotFoundException;
use Src\Exceptions\UnauthorizedException;
use Src\Exceptions\CsrfTokenException;
use Src\Exceptions\FormException;
use Src\Models\Articles\Article;


class ArticlesController extends Controller
{

    public function all()
    {
        $articles = Article::findAll();

        $this->view->renderHtml('Articles/all.php', ['articles' => $articles]);

    }
    public function view(int $articleId)
    {
        $article = Article::getById($articleId);
        if($article === null){
            throw new NotFoundException();
        }

        $this->view->renderHtml('Articles/view.php', ['article' => $article]);
    }
    public function regex(int $articleId, string $str1, string $str2,)
    {
        echo $str1, '<br>', $str2;
    }
    public function edit(int $articleId)
    {
        $article = Article::getById($articleId);
        if($article === null){
            throw new NotFoundException();
        }
        if($this->user === null){
            throw new UnauthorizedException();
        }
        if(!empty($_POST)){
            try {
                $article->updateFromArray($_POST);
            }catch (InvalidArgumentException $e){
                $this->view->renderHtml('Articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }
            header("Location: {$this->baseDir}articles/" . $article->getId(), true, 302);
            exit();
        }
        $this->view->renderHtml('Articles/edit.php', ['article' => $article]);
    }
    public function delete(int $articleId)
    {
        $article = Article::getById($articleId);
        if($article === null){
            throw new NotFoundException();
        }
        if($this->user === null){
            throw new UnauthorizedException();
        }
        $article->delete();
        header("Location: {$this->baseDir}articles/all", true, 302);
    }
    public function add():void{

        if($this->user === null){
            throw new UnauthorizedException();
        }

        if(!empty($_POST)){
            try {
                if($_SESSION['csrf_token'] != $_POST['csrf_token']){
                    throw new CsrfTokenException('CSRF-токен истек');
                }
                $article = Article::createFromArray($_POST, $this->user);
            }catch (FormException $e){
                $this->view->renderHtml('Articles/add.php', ['error' => $e->getMessage()]);
                return;
            }
            header("Location: {$this->baseDir}articles/" . $article->getId(), true, 302);
            exit();
        }
        $this->view->renderHtml('Articles/add.php');
    }
}