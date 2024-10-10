<?php

class keukenType {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getKeukenType($keukenType_id) {
        
        $sql = "SELECT * from keuken_type where id = $keukenType_id";

        $result = mysqli_query($this->connection, $sql);
        $keukenType = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return $keukenType;
    }

}