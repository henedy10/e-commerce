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
        if($row=mysqli_fetch_assoc($result)){
            if(password_verify($password,$row['password'])){
                return "login is successfull";
            } else {
                return "your pass is invalid , check your info";
            }
        } else {
            return "this account is not exist";
        }

    }
}















?>
