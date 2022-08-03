<?php

session_start();
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);

require("./models/database.class.php");
require("./models/user.class.php");
require("./models/tasklist.class.php");

if (isset($_SESSION['taskies_id_user'])) {
    $user = new User();
    $userinfos = $user->getAllInfos($_SESSION['taskies_id_user']);
}

$params = explode('/', $_GET['p']);
$servername = explode('/', $_SERVER['SCRIPT_NAME']);


?>


<?php

if (!file_exists("views/" . $params[0] . ".php") && $params[0] != "") {
    $title = 'Page introuvable | Taskies';
} elseif ($params[0] == "") {
    $title = 'Taskies | Bienvenue sur taskies, Organiser votre planning commme vous le voulez';
} elseif ($params[0] == "register") {
    $title = 'Taskies | S\'inscrire';
} elseif ($params[0] == "login") {
    $title = 'Taskies | S\'identifier';
} elseif ($params[0] == "todolist") {
    $title = 'Taskies | Accueil';
} else {
    $title = 'Page introuvable | Taskies';
}

?>


<!DOCTYPE html>
<html lang="fr-fr">

<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <script src="views/assets/jquery-3.6.0.js"></script>
    <script src="views/assets/script.js"></script>
    <link rel="stylesheet" href="views/assets/style.css">
    <link rel="icon" href="views/assets/fav.png">
    <title><?= $title ?></title>
</head>

<body>
    <?php
    if ($params[0] == "") {
        $filename = "views/index.php";
        if (file_exists($filename)) {
            require_once($filename);
        } else {
            if (file_exists("views/error404.php")) {
                require_once("views/error404.php");
            } else {
                require_once("views/index.php");
            }
        }
    } else {

        $filename = "views/" . $params[0] . ".php";
        if (file_exists($filename)) {
            require_once($filename);
        } else {
            if (file_exists("views/error404.php")) {
                require_once("views/error404.php");
            } else {
                require_once("views/index.php");
            }
        }
    } ?>
</body>

</html>