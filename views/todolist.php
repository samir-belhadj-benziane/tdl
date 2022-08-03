<?php if (isset($_SESSION['taskies_id_user'])) { ?>
    <main>
        <nav class="navigation-main">
            <button type="button" class="button-one tasknotvalid">Taches en cours</button>
            <div class="input-add-task button-one">
                <input type="text" class="input-two input-add" placeholder="Ajouter une tache">
                <button type="button" class="button-round box-shadow-one add-task-input">+</button>
            </div>
            <button type="button" class="button-one taskvalid">Taches Valide</button>
        </nav>
        <section class="view-main">
            <h2 class="margin-one h2center">Vous n'avez selectionne taches en cours ou valide.</h2>
        </section>
    </main>

    <div class="button-round box-shadow-one deco">
        <img src="https://cdn.icon-icons.com/icons2/2368/PNG/512/exit_icon_143788.png" alt="">
    </div>

<?php } else { ?>

    <?php header("Refresh:0; url= .."); ?>

<?php } ?>