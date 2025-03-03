<?php 
include "db.php";
class User{
    public $name;
    public $email;
    public $password;
    public $confirmpass;
    private $db;

    function __construct()
    {
        $this->db = new DataBase();
    }

    public function login($email,$password){
        $this -> email = $email;
        $this -> password = $password;
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
    
    public function signup($name,$email,$password,$confirmpass){
        $hashedpass = "";
        $this -> email = $email;
        $this -> name = $name;
        $this -> password = $password;
        $this -> confirmpass = $confirmpass;
        if(empty($email)||empty($password)||empty($name)||empty($confirmpass)){
            return "Check that all input is not empty, please";
        } else{
            $hashedpass= password_hash($password,PASSWORD_DEFAULT);
            if(!preg_match("/[a-zA-Z0-9' ]/",$name)){
                return "Your username is Invalid";
            } else if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                return "Your email is Invalid";
            } else if (!password_verify($confirmpass,$hashedpass)){
                return "Check your password again,please";
            } else{
                $sql="SELECT *FROM account WHERE email = '$email'";
                $result= mysqli_query($this->db->connect,$sql);
                if(mysqli_num_rows($result)>0){
                    return "This email is exist already";
                } else{
                    $sql = "INSERT INTO account (name,email,password) VALUES ('$name','$email','$hashedpass')";
                    $result= mysqli_query($this->db->connect,$sql);
                    if($result){
                        return "Create your account is done successfully ";
                    }
                }
            }
        }
    }
}















?>
