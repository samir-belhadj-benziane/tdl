<?php

session_start();
extract($_POST);

require_once("../models/database.class.php");
require_once("../models/user.class.php");


$user = new User();


$username = htmlspecialchars($_POST['username']);
$mail = htmlspecialchars(trim($_POST['mail']));
$password = htmlspecialchars($_POST['password']);
$date = htmlspecialchars($_POST['date']);

echo $user->register($username, $mail, $password, $date);

