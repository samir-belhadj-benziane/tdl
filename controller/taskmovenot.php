<?php

session_start();
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
extract($_POST);

require_once("../models/database.class.php");
require_once("../models/user.class.php");
require_once("../models/tasklist.class.php");




$id = intval($_POST['id']);

$getallinfos = $connect->prepare("UPDATE tasklist SET status = ? WHERE id = ?");
$getallinfos->execute(array(0, $id));

$getallinfos0 = $connect->prepare("UPDATE tasklist SET ending_at = ? WHERE id = ?");
$getallinfos0->execute(array(NULL, $id));

