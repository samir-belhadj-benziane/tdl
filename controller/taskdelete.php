<?php

session_start();
extract($_POST);

require_once("../models/database.class.php");
require_once("../models/user.class.php");
require_once("../models/tasklist.class.php");




$id = intval($_POST['id']);

$delete = $connect->prepare('DELETE FROM tasklist WHERE id = ?');
$delete->execute(array($id));

