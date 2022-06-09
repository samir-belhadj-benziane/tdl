<?php session_start(); ?>
<?php require_once("./Include/database.class.php"); ?>
<?php require_once("./Include/user.class.php"); ?>
<?php $user = new User(); ?>

<?php if (isset($_SESSION['id'])) { ?>
    <?php $userinfos = $user->getAllInfos($_SESSION['id']); ?>
    <?php $getlisttasksnotvalid = $user->getListByIdUserAndNotValid(); ?>
    <?php $getlisttasksvalid = $user->getListByIdUserAndValid(); ?>
    <!DOCTYPE html>
    <html lang="fr-fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script src="./js/jquery-3.6.0.js"></script>
        <script src="./js/script.js"></script>
        <title>To do list | Liste de <?= $userinfos['username'] ?> </title>
    </head>

    <body>
        <header>
            <div class="logo"></div>
            <div class="container-add-list">
                <input type="text" name="namelist" class="namelist" placeholder="Ajouter une tache">
                <button type="button" class="button-ein-round add-list"><img src="./img/add.png" alt=""></button>
            </div>
            <nav>
                <button type="button" class="button-simple-ein">Profil</button>
                <button type="button" class="button-ein disconnect">Se Deconnecter</button>
            </nav>
        </header>
        <main>
            <div class="container-ein">
                <div class="container-list">
                    <h2>Mes Taches</h2>
                    <div class="container-multi-tasks">
                        <div class="container-tasks" id="container-tasks-notvalid">
                            <h3>A faire</h3>

                            <div class="menu-list">
                                <div class="name">
                                    <h3>Nom</h3>
                                </div>
                                <div class="created-at">
                                    <h3>Creer le</h3>
                                </div>
                                <div class="ending-at">
                                    <h3>Valider</h3>
                                </div>
                                <div class="delete-task">
                                    <h3>Supprimer</h3>
                                </div>
                            </div>
                            <?php $getlisttasksnotvalidcount = count($getlisttasksnotvalid); ?>
                            <?php if ($getlisttasksnotvalidcount != 0) { ?>

                                <div class="container-multi-task">
                                    <?php foreach ($getlisttasksnotvalid as $getlisttask) { ?>

                                        <div class="container-task">
                                            <div class="name">
                                                <p><?= $getlisttask['name'] ?></p>
                                            </div>
                                            <div class="created-at">
                                                <p><?= $getlisttask['created_at'] ?></p>
                                            </div>
                                            <div class="valid-task" data-idvalid="<?= $getlisttask['id'] ?>">
                                                <button type="button" class="">✅</button>
                                            </div>
                                            <div class="delete-task" data-iddelete="<?= $getlisttask['id'] ?>">
                                                <button type="button" class="">❌</button>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </div>

                            <?php } else { ?>
                                <div class="container-zwei">
                                    <img src="./img/add.png" alt="">
                                    <h3>Creer une nouvelle tache pour la voir ici</h3>
                                </div>
                            <?php } ?>
                        </div>


                        <div class="container-tasks" id="container-tasks-notvalid">
                            <h3>Termine</h3>
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
                                <div class="delete-task">
                                    <h3>Supprimer</h3>
                                </div>
                            </div>
                            <?php $getlisttasksvalidcount = count($getlisttasksvalid); ?>
                            <?php if ($getlisttasksvalidcount != 0) { ?>
                                <div class="container-multi-task" id="container-tasks-valid">
                                    <?php foreach ($getlisttasksvalid as $getlisttask) { ?>

                                        <div class="container-task">
                                            <div class="name">
                                                <p><?= $getlisttask['name'] ?></p>
                                            </div>
                                            <div class="created-at">
                                                <p><?= $getlisttask['created_at'] ?></p>
                                            </div>
                                            <div class="ending-at">
                                                <p><?= $getlisttask['ending_at'] ?></p>
                                            </div>

                                            <div class="delete-task" data-iddelete="<?= $getlisttask['id'] ?>">
                                                <button type="button" class="">❌</button>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </div>

                            <?php } else { ?>
                                <div class="container-zwei">
                                    <img src="./img/add.png" alt="">
                                    <h3>Valider une tache pour la voir ici</h3>
                                </div>
                            <?php } ?>
                        </div>


                    </div>
                </div>

            </div>
            </div>
        </main>
    </body>

    </html>
<?php } else {
    header("Refresh:0; ./");
} ?>