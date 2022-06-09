<?php

session_start();
extract($_POST);

require_once("./database.class.php");
require_once("./user.class.php");


$user = new User();


$username = htmlspecialchars(trim($_POST['username']));
$mail = htmlspecialchars(trim($_POST['mail']));
$password = sha1(trim($_POST['password']));

echo $user->register($username, $mail, $password);