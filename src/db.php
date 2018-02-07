<?php
/**
 * Created by PhpStorm.
 * User: Petr
 * Date: 26.1.2018
 * Time: 18:57
 */


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
        }

        $stm = $this->prepare($query);
        $stm->execute($params);
    }

    public function insertNewUser($name, $password, $email)
    {
        $query = 'INSERT INTO `user`(`name`, `password`, `email`) VALUES (:name, :password, :email)';
        $args = [$name, $password, $email];
        $this->insert($query, $args);  //new user
        $userId = $this->lastInsertId();

        $query = 'INSERT INTO `workgroup`(`name`, `expandable`) VALUES (:name, :expandable)';
        $args = [$name, 0]; //not expandable
        $this->insert($query, $args); //default wkgroup - only user
        $workgroupId = $this->lastInsertId();

        $query = 'INSERT INTO `membership`(`workgroup_id`, `user_id`, `pivilegelvl`) VALUES (:workgroup_id, :user_id, 0)'; // pivilegelvl 0-best; 3-worst
        $args = [$workgroupId, $userId];
        $this->insert($query, $args); //membership for the wkgroup
    }

    
}