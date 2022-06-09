<?php

session_start();
extract($_POST);

require_once("./database.class.php");
require_once("./user.class.php");


$user = new User();


$name = htmlspecialchars($_POST['name']);

$user->addList($name);


$getalllisttasks = $user->getAllListByIdUser();


$getlisttasksvalidcount = count($getalllisttasks);

?>


<?php if ($getlisttasksvalidcount != 0) { ?>
    <?php foreach ($getalllisttasks as $getlisttask) { ?>

        <div class="container-task">
            <div class="name">
                <p><?= $getlisttask['name'] ?></p>
            </div>
            <div class="created-at">
                <p><?= $getlisttask['created_at'] ?></p>
            </div>
            <div class="ending-at" data-end="<?= $getlisttask['id'] ?>">
                <?php if ($getlisttask['ending_at'] != '' || $getlisttask['ending_at'] != NULL) { ?>
                    <p><?= $getlisttask['ending_at'] ?></p>
                <?php } else { ?>
                    <p>En cours</p>
                <?php } ?>
            </div>
            <div class="valid-task" data-id="<?= $getlisttask['id'] ?>">
                <?php if ($getlisttask['ending_at'] != '' || $getlisttask['ending_at'] != NULL) { ?>
                    <button type="button" class="">☒</button>
                <?php } else { ?>
                    <button type="button" class="">☐</button>
                <?php } ?>
            </div>
            <div class="delete-task" data-iddelete="<?= $getlisttask['id'] ?>">
                <button type="button" class="">🗑️</button>
            </div>
        </div>

    <?php } ?>
<?php } else { ?>
    <div class="container-zwei">
        <img src="./img/add.png" alt="">
        <h3>Creer une nouvelle tache pour la voir ici</h3>
    </div>
<?php } ?>