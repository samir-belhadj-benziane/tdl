<?php

session_start();
extract($_POST);

require_once("../models/database.class.php");
require_once("../models/user.class.php");
require_once("../models/tasklist.class.php");



$inputvalue = htmlspecialchars($_POST['inputvalue']);

$todolist = $connect->prepare("INSERT INTO tasklist (name, id_users) VALUES (?, ?)");
$todolist->execute(array($inputvalue, $_SESSION['taskies_id_user']));
