<?php

session_start();
extract($_POST);

require_once("../models/database.class.php");
require_once("../models/user.class.php");


$user = new User();


$mail = htmlspecialchars(trim($_POST['mail']));
$password = sha1(trim($_POST['password']));

echo $user->connection($mail, $password);