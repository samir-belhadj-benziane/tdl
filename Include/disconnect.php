<?php

session_start();
extract($_POST);

require_once("./database.class.php");
require_once("./user.class.php");


$user = new User();

$user->disconnect();