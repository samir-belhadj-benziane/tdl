<?php

session_start();
extract($_POST);

require_once("./database.class.php");
require_once("./user.class.php");


$user = new User();


$iddelete = htmlspecialchars($_POST['iddelete']);

$user->deleteList($iddelete);

$getalllisttasks = $user->getAllListByIdUser();


$getlisttasksvalidcount = count($getalllisttasks);

?>
<?php if ($getlisttasksvalidcount == 0) { ?>

    <div class="container-zwei">
        <img src="./img/add.png" alt="">
        <h3>Creer une nouvelle tache pour la voir ici</h3>
    </div>

<?php } ?>