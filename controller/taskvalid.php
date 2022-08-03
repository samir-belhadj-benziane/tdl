<?php

session_start();
extract($_POST);

require_once("../models/database.class.php");
require_once("../models/user.class.php");
require_once("../models/tasklist.class.php");


?>

<?php $tasklistvalids = $tasklist->getTaskValid(); ?>

<?php if ($tasklistvalids == true) { ?>
    <?php foreach ($tasklistvalids as $tasklistvalid) { ?>

        <div class="bodyviewmain">
            <div class="container-message">
                <div class="infos-messages">
                    <div class="createmessage">
                        <h4 class="margin-one">Date de creation :</h4>
                        <p><?= $tasklistvalid['created_at'] ?></p>
                    </div>
                    <div class="endingmessage">
                        <h4 class="margin-one">Date de fin :</h4>
                        <p><?= $tasklistvalid['ending_at'] ?></p>
                    </div>
                </div>
                <div class="text-messages">
                    <p class="text-in-message"><?= $tasklistvalid['name'] ?></p>
                    <div class="gestion-taches">
                        <button type="button" title="Réinitialiser la tache" class="button-two success validvalid" data-id="<?= $tasklistvalid['id'] ?>">🗘</button>
                        <button type="button" title="Supprimer la tache" class="button-two error deletenotvalid" data-id="<?= $tasklistvalid['id'] ?>">🗑</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <h2 class="margin-one h2center">Vous n'avez pas de taches valide.</h2>
<?php } ?>

<script>
    $(".validvalid").click(function() {
        let id = $(this).attr("data-id");

        $.post(
            "/controller/taskmovenot.php", {
                id: id,
            },

            function() {
                $(".view-main").load("/controller/taskvalid.php");
            }
        );
    });

    $(".deletenotvalid").click(function() {
        let id = $(this).attr("data-id");

        $.post(
            "/controller/taskdelete.php", {
                id: id,
            },

            function() {
                $(".view-main").load("/controller/taskvalid.php");
            }
        );
    });

</script>