<?php 

define("USER", "root");
define("PASSWORD", "");
define("DATABASE", 'verrukkulluk_db');
define("HOST", "localhost");

class Database {

    private $connection;

    public function __construct() {
       $this->connection = mysqli_connect(HOST,                                          
                                          USER, 
                                          PASSWORD,
                                          DATABASE );
    }

    public function getConnection() {
        return($this->connection);
    }
}
