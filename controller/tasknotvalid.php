<?php

session_start();
extract($_POST);

require_once("../models/database.class.php");
require_once("../models/user.class.php");
require_once("../models/tasklist.class.php");


?>

<?php $tasklistnotvalids = $tasklist->getTaskNotValid(); ?>

<?php if ($tasklistnotvalids == true) { ?>
    <?php foreach ($tasklistnotvalids as $tasklistnotvalid) { ?>

        <div class="bodyviewmain">
            <div class="container-message">
                <div class="infos-messages">
                    <h4 class="margin-one">Date de creation :</h4>
                    <p><?= $tasklistnotvalid['created_at'] ?></p>
                </div>
                <div class="text-messages">
                    <p class="text-in-message"><?= $tasklistnotvalid['name'] ?></p>
                    <div class="gestion-taches">
                        <button type="button" title="Valider la tache" class="button-two success validnotvalid" data-id="<?= $tasklistnotvalid['id'] ?>">✓</button>
                        <button type="button" title="Supprimer la tache" class="button-two error deletenotvalid" data-id="<?= $tasklistnotvalid['id'] ?>">🗑</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <h2 class="margin-one h2center">Vous n'avez pas de taches en cours.</h2>
<?php } ?>

<script>
    $(".validnotvalid").click(function() {
        let id = $(this).attr("data-id");

        $.post(
            "/controller/taskmove.php", {
                id: id,
            },

            function() {
                $(".view-main").load("/controller/tasknotvalid.php");
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
                $(".view-main").load("/controller/tasknotvalid.php");
            }
        );
    });

</script>