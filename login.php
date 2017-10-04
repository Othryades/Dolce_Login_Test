<?php
session_start();
$conn = mysqli_connect("localhost","root","","dolce_1");

$message="";
if(!empty($_POST["login"])) {

//    $name = $_POST["user_name"];
////    $username=mysqli_real_escape_string($_POST['user_name']);
////    var_dump($name);
//
////    $hash = mysqli_query($conn,"SELECT password FROM users WHERE user_name= ".$name.".");
//    $hash = mysql_query($conn,'SELECT password FROM users WHERE user_name= ".$name.".');
//
//    var_dump($hash);

    $result = mysqli_query($conn,"SELECT * FROM users WHERE user_name='" . $_POST["user_name"] . "' and password = '". md5($_POST["password"])."'");
    $user  = mysqli_fetch_array($result);
    if(is_array($user)) {
        $_SESSION["user_id"] = $user['user_id'];
    } else {
        $message = "Invalid Username or Password";
    }
}
if(!empty($_POST["logout"])) {
    $_SESSION["user_id"] = "";
    session_destroy();
}
