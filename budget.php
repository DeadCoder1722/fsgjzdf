<?php
//require 'conn.php';
session_start();
$link     = mysqli_connect("localhost", "lejamby", "", "mastercard_budget");

$budget = $_POST['budget'];
$food = $_POST['food'];
$leisure= $_POST['leisure'];
$transportation = $_POST['transportation'];
$utilities = $_POST['utilities'];
$rent = $_POST['rent'];

$username = $_SESSION['username'];

$user_id_result = mysqli_query($link, "SELECT user_id FROM User WHERE username = '$username' ");

$user_id_array=mysqli_fetch_assoc($user_id_result);

$user_id = $user_id_array["user_id"];

$budget_id_result = mysqli_query($link, "SELECT budget_id FROM Profile WHERE user_id = '$user_id' ");

$budget_id_array = mysqli_fetch_assoc($budget_id_result);

$budget_id = $budget_id_array["budget_id"];

echo $budget_id;

mysqli_query($link, "UPDATE Budget SET total = '$budget', food = '$food', other = '$leisure', transport = '$transportation', utility = '$utilities', rent = '$rent' WHERE budget_id = '$budget_id' ");

// $_SESSION['variables'] = [$budget, $food, $leisure, $transportation, $utilities, $rent];
// $_SESSION['budget_variables'] = $_POST;

header("Location: https://mastersofcode-lejamby.c9users.io?dashboard.php");

// echo "UPDATE Budget SET budget = $budget, food = $food, other = $leisure, transportation = $transportation, utilities = $utilities, rent = $rent, WHERE budget_id = $budget_id;";


?>