<?php

namespace Src\Models;
use Src\Services\Db;
abstract class ActiveRecordEntity
{
    protected $id;
    public function getId(): int
    {
        return $this->id;
    }
    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }
    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_','',ucwords($source,'_')));
    }
    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function mapPropertiesToDbFormat(): array{
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $mappedProperties = [];
        foreach($properties as $property){
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }
        return $mappedProperties;
    }

    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if($this->id !== null){
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }
    private function update(array $mappedProperties): void
    {
        $columns2params = [];
        $columns2values = [];
        $index = 1;
        foreach($mappedProperties as $column => $value){
            $param = ':param'.$index;
            $columns2params[] = $column.' = '.$param;
            $columns2values[$param] = $value;
            $index++;

        }
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;

        $db = Db::getInstance();
        $db->query($sql, $columns2values, static::class);

    }
    private function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);
        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach($filteredProperties as $columnName => $value){
            $columns[] = '`'.$columnName.'`';
            $paramsName = ':'.$columnName;
            $paramsNames[] = $paramsName;
            $params2values[$paramsName] = $value;
        }
        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);
        $sql = 'INSERT INTO '.static::getTableName().' ('.$columnsViaSemicolon.') VALUES ('.$paramsNamesViaSemicolon.');';
        $db = Db::getInstance();
        $db->query($sql, $params2values,static::class);
        $this->id = $db->getLastInsertId();
    }
    public function delete()
    {
        $db = Db::getInstance();
        $db->query('DELETE FROM `'.static::getTableName().'` WHERE id = :id', [':id'=>$this->id]);
        $this->id = null;
    }
    public static function findAll() :array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }
    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `'.static::getTableName().'`WHERE id = :id;', [':id' => $id], static::class);
        return $entities ? $entities[0] : null;
    }
    public static function findOneByColumn(string $columnName, $value): ?self{
        $db = Db::getInstance();
        $result = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;', [':value' => $value], static::class);
        if ($result === []){
            return null;
        }
        return $result[0];
    }
    public static function findByColumn(string $columnName, $value): ?array{
        $db = Db::getInstance();
        $result = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value;', [':value' => $value], static::class);
        if ($result === []){
            return null;
        }
        return $result;
    }
    abstract protected static function getTableName(): string;

}