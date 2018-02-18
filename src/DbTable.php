<?php
/**
 * Created by PhpStorm.
 * User: Petr
 * Date: 12.2.2018
 * Time: 16:21
 */

require_once 'db.php';

class DbTable
{
    private $fields = [];
    private $tblName = '';
    private $db;

    public function __construct(array $tableDescription, string $tblName,DB $db)
    {
        $this->db = $db;
        $this->tblName = $tblName;
        foreach ($tableDescription as $column){
            $this->fields[$column['Field']] = ['type' => $column['Type'],'null' => $column['Null'],'key' => $column['Key']];
        }
    }

    public function newRow(array $data)
    {
        $fieldsWithoutId = '';
        $fieldsWithoutIdParams = '';

        foreach ($this->fields as $name => $metadata){
            if ($metadata['key'] != 'PRI') $fieldsWithoutId .= $name . ',';
            if ($metadata['key'] != 'PRI') $fieldsWithoutIdParams .= ':' . $name . ',';
        }

        $query = 'INSERT INTO ' . $this->tblName . ' (' . $fieldsWithoutId . ') VALUES (' . $fieldsWithoutIdParams . ')';

        $this->db->insert($query, $data);
    }

    public function deleteRowById(int $id)
    {
        $key = array_search('PRI', array_column($this->fields, 'key'));

        $query = 'DELETE FROM ' . $this->tblName . ' WHERE ' . $key . ' = :' . $key;

        $this->db->delete($query, [$id]);
    }

    public function deleteRowByParam(string $param, $paramValue)
    {
        $query = 'DELETE FROM ' . $this->tblName . ' WHERE ' . $param . ' = :' . $param;

        $this->db->delete($query, [$paramValue]);
    }

    public function getRowById(int $id)
    {
        $key = array_search('PRI', array_column($this->fields, 'key'));

        $query = 'SELECT * FROM' . $this->tblName . ' WHERE ' . $key . ' = :' . $key;

        return $this->db->select($query, [$id]);
    }

    public function getRowByParam(string $param, $paramValue)
    {
        $query = 'SELECT * FROM ' . $this->tblName . ' WHERE ' . $param . ' = :' . $param;

        return $this->db->select($query, [$paramValue]);
    }

}