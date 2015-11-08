<?php
//require 'conn.php';
$link     = mysqli_connect("localhost", "lejamby", "", "mastercard_budget");

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

mysqli_query($link, "INSERT INTO User (username,fname,lname,email,password)
VALUES ('$username','$firstname','$lastname','$email','$password')");

$usresult = mysqli_query($link, "SELECT user_id
FROM User WHERE username = '$username'");
$user_id=mysqli_fetch_assoc($usresult);
$us_id = $user_id["user_id"];

$bresult = mysqli_query($link, "SELECT budget_id
FROM Budget ORDER BY budget_id DESC LIMIT 1");
$row=mysqli_fetch_assoc($bresult);
$budget_id = $row["budget_id"];

mysqli_query($link, "INSERT INTO Profile (user_id,budget_id)
VALUES ('$us_id','$budget_id')");
header("Location: https://mastersofcode-lejamby.c9users.io?accountgood");

?>