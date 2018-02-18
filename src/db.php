<?php
/**
 * Created by PhpStorm.
 * User: Petr
 * Date: 26.1.2018
 * Time: 18:57
 */

require_once 'DbTable.php';

class DB extends PDO
{
    public function __construct(array $dbconfig)
    {
        parent::__construct($dbconfig['driver'] . ':host=' . $dbconfig['host'] . ';dbname=' . $dbconfig['dbname'], $dbconfig['username'], $dbconfig['password']);
    }

    public function select($query, $args)
    {
        $matches = [];
        preg_match(':[a-zA-Z]*',$query,$matches);

        $params = [];
        $i=0;
        foreach ($matches as $match){
            $params[$match] = $args[$i];
        }
        $stm = $this->prepare($query);
        $stm->execute($params);

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert($query, $args)
    {
        $matches = [];
        preg_match(':[a-zA-Z]*',$query,$matches);

        $params = [];
        $i=0;
        foreach ($matches as $match){
            $params[$match] = $args[$i];
            $i++;
        }

        $stm = $this->prepare($query);
        $stm->execute($params);
    }
    public function update($query, $args)
    {
        $matches = [];
        preg_match(':[a-zA-Z]*',$query,$matches);

        $params = [];
        $i=0;
        foreach ($matches as $match){
            $params[$match] = $args[$i];
            $i++;
        }

        $stm = $this->prepare($query);
        $stm->execute($params);
    }
    public function delete($query, $args)
    {
        $matches = [];
        preg_match(':[a-zA-Z]*',$query,$matches);

        $params = [];
        $i=0;
        foreach ($matches as $match){
            $params[$match] = $args[$i];
            $i++;
        }

        $stm = $this->prepare($query);
        $stm->execute($params);
    }

    public function table(string $tblName)
    {
        $tableDescription = [];
        $query = 'DESCRIBE ' . $tblName;

        $tableDescription = $this->select($query, []);

        return new DbTable($tableDescription, $tblName, $this);
    }

}