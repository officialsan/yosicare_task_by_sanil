<?php
namespace Yosicare\Task\Database;
use PDO;
use PDOException;
use Yosicare\Task\Config;
abstract class Database 
{    
    /**
     * conn
     *
     * @var ?PDO
     */
    public $conn;   
    private $host;
    private $db_name;
    private $username;
    private $password;
    public function __construct()
    {
        $this->host = Config::HOST;
        $this->db_name = Config::DATABASE;
        $this->username = Config::USERNAME;
        $this->password = Config::PASSWORD;
        $this->conn = $this->getConnection();
    }
    
    /**
     * getConnection
     * Connecting with database
     * @return ?PDO
     */
    private   function getConnection()
    {
        $conn = null;
        try{
            $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $conn;
    }
       
    /**
     * getId
     * Get the data with Id 
     * @param  mixed $id
     * @return object
     */
    abstract public function getId(int $id) :?array;    
    /**
     * getCount
     * Get the count with condition
     * @param  mixed $condition
     * @return int
     */
    abstract public function getCount(String $condition = ""):int;    
    /**
     * all
     * get all data with condition
     * 
     */
    abstract public function all(String $condition = "");
    
    /**
     * check the table is exist
     *
     * @return bool
     */
    abstract protected function tableIsExist():bool;
    
    /**
     * To create table
     *
     * @return void
     */
    abstract protected function createTable():void;
    
    /**
     * update
     *
     * @return bool
     */
    abstract public function update():bool   ; 

    /**
     * delete
     *
     * @return bool
     */
    abstract public function delete():bool;
}