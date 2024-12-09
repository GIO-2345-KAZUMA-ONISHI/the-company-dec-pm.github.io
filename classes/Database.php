<?php

class Database{
    private $servername ="localhost";
    private $username = "root";
    private $password = "";  // for MAMP users, please use 'root' value
    private $db_name = "the_company_dec_pm";
    protected $conn;

    public function __construct(){

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db_name);

        if($this->conn->connect_error){
            die("Unable to connect to the database: " . $this->conn->connect_error);
        }
    }
}
?>