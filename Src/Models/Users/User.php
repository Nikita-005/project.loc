<?php

namespace Src\Models\Users;

use Src\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected $nickname;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $createdAt;
    public function getNickname(): string
    {
        return $this->nickname;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getIsConfirmed(): int
    {
        return $this->isConfirmed;
    }
    public function getRole(): string
    {
        return $this->role;
    }
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
    public function getAuthToken(): string
    {
        return $this->authToken;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    public static function getTableName(): string
    {
        return 'users';
    }
    public static function signUp(array $userData) 
    {
        var_dump($userData);
    }
}