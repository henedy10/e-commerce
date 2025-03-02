<?php 
include "db.php";
class User{
    private $db;

    function __construct()
    {
        $this->db = new DataBase();
    }

    public function login($email,$password){
        if(empty($email)||empty($password)){
            return "Check that all input is not empty, please";
        }else{
            $sql = "SELECT *FROM account WHERE email ='$email'";
            $result= mysqli_query($this->db->connect,$sql);
            if($row=mysqli_fetch_assoc($result)){
                if(password_verify($password,$row['password'])){
                    return "Login is successfull";
                } else {
                    return "Your pass is invalid , check your info";
                }
            } else {
                return "This account is not exist";
            }
        }

    }
}















?>
