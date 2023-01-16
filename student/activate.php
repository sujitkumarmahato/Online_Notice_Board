<?php
session_start();
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"notice_board_db");

if(isset($_GET['token'])){
    $token=$_GET['token'];

    $updatequery=" update student set status='active' where token='$token' ";

    $query=mysqli_query($connection, $updatequery );

    if($query){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg']="Account Activated successfully";
            header('location: student_login.php');
        }else{
            $_SESSION['msg']="You are Logged out." ;
            header('location: student_login.php');
        }
    }
    else{
        $_SESSION['msg']="Account not updated" ;
            header('location: student_signup.php');
    }
}

?>