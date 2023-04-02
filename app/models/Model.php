<?php


namespace app\models;
use mysqli;


class Model
{
    private $db;

    public function __construct()
    {
        $dbparam = require ('app/config/db.php');
        $this->db = new mysqli($dbparam['host'], $dbparam['user'], $dbparam['password'], $dbparam['dbname']);
        if ($this->db->connect_error) {
            die('Connect Error (' . $this->db->connect_errno . ') ' . $this->db->connect_error);
        }
    }

    public function query($sql)
    {
        $result = $this->db->query($sql);
        if (!$result) {
            die('Error (' . $this->db->errno . ') ' . $this->db->error);
        }
        return $result;
    }

    public function escape($value)
    {
        return $this->db->real_escape_string($value);
    }
}

