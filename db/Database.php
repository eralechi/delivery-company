<?php

namespace DB;

class Database
{
    const DB_NAME = 'delivery_company';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_HOST = 'localhost';
    const DB_CHARSET = 'utf8mb4';

    private static Database $instance;
    private $db;

    private function __construct()
    {
        try {
            $db = new \mysqli(self::DB_HOST, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);
            $db->query("SET NAMES '" . self::DB_CHARSET . "'");
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
        $this->db = $db;
    }

    public static function getInstance() 
    {
        if (!isset(self::$instance) || self::$instance == null)
            self::$instance = new Database();
        
        return self::$instance;
    }
  
    public function query($sql)
    {
        $result = $this->db->query($sql);
        return $result;
    }

    public function escape($string)
    {
        $string = $this->db->real_escape_string($string);
        return $string;
    }
}
