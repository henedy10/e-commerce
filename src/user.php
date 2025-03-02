<?php 
include "db.php";
class User{
    private $db;

    function __construct()
    {
        $this->db = new DataBase();
    }

    public function login($email,$password){
        $sql = "SELECT *FROM account WHERE email ='$email'";
        $result= mysqli_query($this->db->connect,$sql);
        if($result)
            header("location : index.php");
        else 
        return "this account is not exist ";
    }
}















?>
