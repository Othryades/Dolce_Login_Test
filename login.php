<?php
session_start();
$conn = mysqli_connect("localhost","root","","dolce_1");

$message="";
if(!empty($_POST["login"])) {
    $result = mysqli_query($conn,"SELECT * FROM users WHERE user_name='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
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
