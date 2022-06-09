<div class="container-multi-tasks">
    <div class="container-tasks" id="container-tasks-notvalid">
        <h4>A faire</h4>
        <?php $getlisttasksnotvalidcount = count($getlisttasksnotvalid); ?>
        <?php if ($getlisttasksnotvalidcount != 0) { ?>
            <?php foreach ($getlisttasksnotvalid as $getlisttask) { ?>


                <div class="menu-list">
                    <div class="name">
                        <h3>Nom</h3>
                    </div>
                    <div class="created-at">
                        <h3>Creer le</h3>
                    </div>
                    <div class="ending-at">
                        <h3>Valider le</h3>
                    </div>
                </div>
                <div class="ending-at">
                    <h3>Supprimer</h3>
                </div>
    </div>
    <div class="container-task container-task-notvalid" data-idtask="<?= $getlisttask['id'] ?>">


        <div class="name">
            <p><?= $getlisttask['name'] ?></p>
        </div>
        <div class="created-at">
            <p><?= $getlisttask['created_at'] ?></p>
        </div>
        <div class="ending-at">
            <p><?= $getlisttask['ending_at'] ?></p>
        </div>


        <!-- <div class="valid-task" data-idvalid="<?= $getlisttask['id'] ?>"><button type="button" class="">✅</button></div> -->
        <div class="delete-task" data-iddelete="<?= $getlisttask['id'] ?>"><button type="button" class="">❌</button></div>
        <!-- <div class="edit-task"><button type="button" class="">✎</button></div> -->
    </div>
<?php } ?>
<?php } else { ?>
    <div class="container-zwei">
        <img src="./img/add.png" alt="">
        <h3>Creer une nouvelle tache pour la voir ici</h3>
    </div>
<?php } ?>

<div class="container-tasks" id="container-tasks-valid">
    <h4>Termine</h4>
    <?php $getlisttasksvalidcount = count($getlisttasksvalid); ?>
    <?php if ($getlisttasksvalidcount != 0) { ?>
        <?php foreach ($getlisttasksvalid as $getlisttask) { ?>


            <div class="container-task container-task-valid" data-idtask="<?= $getlisttask['id'] ?>">
                <div class="name">
                    <h3>Nom</h3>
                </div>
                <div class="created-at">
                    <h3>Creer le</h3>
                </div>
                <div class="ending-at">
                    <h3>Valider le</h3>
                </div>

                <div class="name">
                    <p><?= $getlisttask['name'] ?></p>
                </div>
                <div class="created-at">
                    <p><?= $getlisttask['created_at'] ?></p>
                </div>
                <div class="ending-at">
                    <p><?= $getlisttask['ending_at'] ?></p>
                </div>
                <!-- <div class="valid-task"><button type="button" class="">✅</button></div> -->
                <div class="delete-task" data-iddelete="<?= $getlisttask['id'] ?>"><button type="button" class="">❌</button></div>
                <!-- <div class="edit-task"><button type="button" class="">✎</button></div> -->
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="container-zwei" id="tasksvalidempty">
            <img src="./img/add.png" alt="">
            <h3>Valider une tache pour la voir ici</h3>
        </div>
    <?php } ?>
</div>
</div>