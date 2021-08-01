<?php 
session_start();
//Database Configuration File
include_once "./includes/config.php";

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql ="SELECT * FROM users WHERE email=:usemail  and password=:usrpassword";
    $query= $con -> prepare($sql);
    $query-> bindParam(':usemail', $email, PDO::PARAM_STR);
    $query-> bindParam(':usrpassword', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetch(PDO::FETCH_ASSOC);

     if($query->rowCount() > 0)
  {
    $_SESSION['user_email']=$_POST['email'];
    $_SESSION['user_name']=$results['name'];
    $_SESSION['user_id']=$results['id'];


    $_SESSION['status']= "Login Successfully";
     header("Location: index.php");
     exit();


  } else{
      
    $_SESSION['status']= "Invalid Email Or Password";
     header("Location: index.php");
     exit();
    
  }

}

?>