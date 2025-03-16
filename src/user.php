<?php 
session_start();
include "db.php";
class User{
    public $name;
    public $email;
    public $message;
    public $password;
    public $new_pass;
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
                    $_SESSION['name']=$row['name'];
                    header("location: index.php");
                } else {
                    return "Your pass is invalid , check your info";
                }
            } else {
                return "This account is not exist";
            }
        }
    }
    
    public function signup($name,$email,$password,$confirmpass,$checkbox){
        $hashedpass = "";
        $this -> email = $email;
        $this -> name = $name;
        $this -> password = $password;
        $this -> confirmpass = $confirmpass;
        if(empty($email)||empty($password)||empty($name)||empty($confirmpass)){
            return "Check that all input is not empty, please";
        }elseif($checkbox==null){
            return "You should agree with terms&condition,please";
        }
        else{
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
    
    public function contact($name,$email,$catagory,$message,$checkbox){
        $this -> email = $email;
        $this -> name = $name;
        $this -> message = $message;
        if(empty($email)||empty($name)||empty($catagory)||empty($message)){
            return "Check that all input is not empty, please";
        }elseif($checkbox==null){
            return "You should agree with terms&condition,please";
        }else{
            $sql = "SELECT *FROM account WHERE name='$name' AND email='$email' ";
            $result= mysqli_query($this->db->connect,$sql);
            if(mysqli_num_rows($result)<=0){
                return "This account is not exist, you must have an account to send message ";
            }else{
                $sql="SELECT *FROM contact WHERE name='$name' AND email='$email'";
                $result= mysqli_query($this->db->connect,$sql);
                if(mysqli_num_rows($result)>0){
                    return "You sent a message before ";
                }else{
                    $sql="INSERT INTO contact (name,email,catagory,message) VALUES ('$name','$email','$catagory','$message')";
                    $result= mysqli_query($this->db->connect,$sql);
                    if($result){
                        return "Your message is sent successfully";
                    }
                }
            }
        }
    }
    
    public function change_password($email,$current_pass,$new_pass,$repeat_new_pass){

        $checkemail=isset($_SESSION['email']) ? $_SESSION['email'] : null;
        $hashedpass = "";
        
        if(empty($email)||empty($current_pass)||empty($new_pass)||empty($repeat_new_pass)){
            return "Check that all input is not empty, please";
        }elseif($checkemail==null){
            return "You should log in first";
        }else{
            $this -> email = $email;
            $this -> password = $current_pass;
            $this -> new_pass = $new_pass;
            $this -> confirmpass = $repeat_new_pass;
            $sql = "SELECT *FROM account WHERE email='$email' ";
            $result= mysqli_query($this->db->connect,$sql);
            if(mysqli_num_rows($result)<=0){
                return "This account is not exist! ";
            }else{
                $row=mysqli_fetch_assoc($result);
                
                if(!password_verify($current_pass,$row['password'])){
                    return "Your password is Incorrect, check your info!";
                }else{
                    if($new_pass!=$repeat_new_pass){
                        return "There is an error , check your info again";
                    }else{
                        $hashedpass= password_hash($new_pass,PASSWORD_DEFAULT);
                        $sql = "UPDATE account SET password='$hashedpass' WHERE email='$email'";
                        $result= mysqli_query($this->db->connect,$sql);
                        if($result){
                            return "Your Update is done successfully";
                        }
                    }
                }
            }
        }
    }
    
    public function checkname(){
        $checkname=isset($_SESSION['name'])? $_SESSION['name']:"Your name";
        
        return $checkname;
    }
    
    public function info($image,$first_name,$last_name,$bio){
        $checkemail= isset($_SESSION['email'])? $_SESSION['email']:null;
        if(empty($first_name)||empty($last_name)||empty($bio)){
            return "Check that all input is not empty, please";
        }else{
            if(!preg_match('/^[a-zA-Z0-9]*$/',$first_name)){
                return"Your first-name is Invalid";
            }elseif(!preg_match('/^[a-zA-Z0-9]*$/',$last_name)){
                return"Your last-name is Invalid";
            }else{
                if($checkemail==null){
                    return "you should login first";
                }else{
                    $sql="UPDATE account SET first_name='$first_name' 
                    , last_name ='$last_name' 
                    , image='$image' 
                    , bio='$bio' WHERE email ='$checkemail'";
                    
                    $result= mysqli_query($this->db->connect,$sql);
                    if($result){
                        return "your changes is saved successfully";
                    }
                }
            }
        }
        
    }
    
    public function address($country,$city,$zip_code){
        if(empty($country)||empty($city)||empty($zip_code)){
            return "Check that all input is not empty, please";
        }else{
            $checkemail=isset($_SESSION['email']) ? $_SESSION['email'] : null;
            if($checkemail==null){
                return "You should log in first!";
            }else{

                $sql="UPDATE account SET country='$country' 
                , city ='$city' 
                , zip_code='$zip_code' WHERE email ='$checkemail'";
                
                $result= mysqli_query($this->db->connect,$sql);
                if($result){
                    return "your changes is saved successfully";
                }
            }
        }
    }
}
?>
