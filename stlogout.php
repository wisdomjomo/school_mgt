<?php
//create a session start
session_start();
// function to logout student
if(!isset($_SESSION['unauthorised'])){
    session_destroy();
    unset($_SESSION['unauthorised']);
    // redirect student to login page after logout
    header('location:stlogin.php');
}
?>