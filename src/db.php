<?php
class DataBase {
    private $host = "localhost";
    private $name = "ahmed";
    private $pass = "";
    private $databasename = "E_Commerce";
    public $connect;

    function __construct()
    {
        $this -> connect = mysqli_connect($this-> host,$this-> name,$this->pass,$this->databasename);
        if(!$this->connect){
            die("Connection failed: ".mysqli_connect_error($this -> connect));
        }
    }
}
?> 