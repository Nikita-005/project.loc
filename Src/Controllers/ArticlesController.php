<?php

namespace Src\Controllers;

use Src\Exceptions\NotFoundException;
use Src\Views\View;
use Src\Models\Articles\Article;
use Src\Models\Users\User;


class ArticlesController
{

    private $view;
    private $layout = 'default';


    public function __construct()
    {
        $this->view = new View($this->layout);
    }
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
    public function edit(int $articleId)
    {
        $article = Article::getById($articleId);
        if($article === null){
            $this->view->renderHtml('Errors/404.php',[],404);
            return;
        }
        // $article->name('Новый заголовок');
        $article->setText('Новый текст');
        $article->save();
    }
    public function delete(int $articleId)
    {
        $article = Article::getById($articleId);
        if($article === null){
            $this->view->renderHtml('Errors/404.php',[],404);
            return;
        }
        $article->delete();
        var_dump($article);
    }
    public function add():void{
        $article = new Article();
        $author = User::getById(1);
        $article->setAuthor($author);
        $article->setName('Еще статья');
        $article->setText('Соодержание fewrrerfffds e');

        $article->save();
        var_dump($article);
    }
}