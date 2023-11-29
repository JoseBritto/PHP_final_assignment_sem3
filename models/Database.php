<?php

require "utils/config.php";

class Database
{

    private static $instance;
    /**
     * @var false|mysqli
     */
    private $conn;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function __construct()
    {
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->conn) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    public function __destruct()
    {
        $this->conn->close();
    }

    /**
     * @param string $username
     * @return User|null
     */
    public function tryGetUser($username){
        $sql = "SELECT * FROM registered_users WHERE username = '$username'";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            return new User($row['user_id'],$row['username'], $row['password'], $row['display_name'], $row['profile_pic'], $row['registered_at']);
        }
        return null;
    }
}