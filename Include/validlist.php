<?php

session_start();
extract($_POST);

require_once("./database.class.php");
require_once("./user.class.php");


$user = new User();


$idvalid = intval($_POST['idvalid']);

echo $user->validList($idvalid);