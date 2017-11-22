<?php
include('connect.php');
session_start();
$email_check=$_SESSION['email'];
 
$sql = mysqli_query($conn,"SELECT user_emailadres FROM users WHERE user_emailadres='$email_check' ");
 
$row=mysqli_fetch_array($sql,MYSQLI_ASSOC);
 
$email_user=$row['user_emailadres'];
 
if(!isset($email_check))
{
header("Location: login.php");
}