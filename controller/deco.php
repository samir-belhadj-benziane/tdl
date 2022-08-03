<?php

session_start();
extract($_POST);

require_once("../models/database.class.php");
require_once("../models/user.class.php");


session_destroy();