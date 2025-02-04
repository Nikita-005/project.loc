<?php

namespace Src\Services;

use Src\Exceptions\DbException;

class Db
{
    private $pdo;
    private static $instance;
    private function __construct()
    {
        $dbOptions = (require __DIR__.'/../Config/settings.php')['db'];
        try {
            $this->pdo = new \PDO(
                'mysql:host='.$dbOptions['host'].';dbname='.$dbOptions['dbname'], $dbOptions['user'], $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');
        } catch(\PDOException $e) {
            throw new DbException('Ошибка подключения к базе данных: '. $e->getMessage());
        }
    }
    public function query(string $sql, $param=[], string $className = 'stdClass')
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($param);

        if(false === $result){
            return null;
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }
    public static function getInstance(): self
    {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}