<?php

namespace Src\Models\Articles;

use Src\Models\ActiveRecordEntity;
use Src\Models\Users\User;


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
}