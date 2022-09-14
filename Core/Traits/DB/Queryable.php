<?php

namespace Core\Traits\DB;

use Core\Db;
use PDO;

trait Queryable
{


    static protected string|null $tableName = "users";

    static protected string $query = "";

    protected $commands = [];

    public static function all(): static
    {
        static::$query = "SELECT * FROM " . static::$tableName;
        $obj = new static();
        $obj->commands[] = 'all';
        return $obj;
        //    return Db::connect()->query($query)->fetchAll(PDO::FETCH_CLASS, static::class);
    }


    /**
     * @param int $id
     * @return mixed
     */
    public static function find(int $id)
    {
        $query = "SELECT * FROM " . static::$tableName . " WHERE id=:id";

        $query = Db::connect()->prepare($query);
        $query->bindParam('id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchObject(static::class);
    }


    /**
     * @param int $id
     * @return mixed
     */
     public static function findBy(string $column,  $value)
     {
         $query = "SELECT * FROM " . static::$tableName . " WHERE {$column}=:{$column}";

         $query = Db::connect()->prepare($query);
         $query->bindValue($column, $value);
         $query->execute();
         return $query->fetchObject(static::class);

     }


    public function orderBY($column, $direction = 'ASC')
    {
        if ($this->allowMethod(['all', 'select'])) {
            $this->commands[] = 'order';
            static::$query .= " ORDER BY {$column}  {$direction}";
        }
        return $this;
    }


    public function get()
    {
        return Db::connect()->query(static::$query)->fetchAll(PDO::FETCH_CLASS, static::class);

    }

    protected function allowMethod(array $allowedMethods)
    {
        foreach ($allowedMethods as $method) {
            if (is_array($method, $this->commands)){
                return true;
            }

        }
        return false;
    }



}