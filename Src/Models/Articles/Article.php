<?php

namespace Src\Models\Articles;

use Src\Models\ActiveRecordEntity;
use Src\Models\Users\User;
use Src\Exceptions\InvalidArgumentException;



class Article extends ActiveRecordEntity
{
    // private $id;
    protected $name;
    protected $text;
    protected $authorId;
    protected $createdAt;


    public function getName(): string
    {
        return $this->name;
    }
    public function getText(): string
    {
        return $this->text;
    }
    public function getAuthorId(): int
    {
        return (int )$this->authorId;
    }
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }
    public function setName($newName)
    {
        $this->name = $newName;
    } 
    public function setText($newText)
    {
        $this->text = $newText;
    }
    public function setAuthor(User $author)
    {
        $this->authorId = $author->getId();
    }
    public static function getTableName(): string
    {
        return 'articles';
    }
    public static function createFromArray(array $fields, User $author): Article
    {
        if(empty($fields['name'])){
            throw new InvalidArgumentException('Не передано название статьи');
        }
        if(empty($fields['text'])){
            throw new InvalidArgumentException('Не передан текст статьи');
        }
        $article = new Article();
        $article->setAuthor($author);
        $article->setName($fields['name']);
        $article->setText($fields['text']);

        $article->save();

        return $article;

    }
    public function updateFromArray(array $fields): Article
    {
        if(empty($fields['name'])){
            throw new InvalidArgumentException('Не передано название статьи');
        }
        if(empty($fields['text'])){
            throw new InvalidArgumentException('Не передан текст статьи');
        }     
        $this->setName($fields['name']);
        $this->setText($fields['text']);

        $this->save();

        return $this;   
    }
}