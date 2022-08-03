<?php if (isset($_SESSION['taskies_id_user'])) { ?>

    <?php header("Refresh:0; url= todolist"); ?>

<?php } else { ?>
    <header>
        <button type="button" class="button-one box-shadow-one RegisterLink">S'inscrire</button>
        <nav>
            <div class="logo-container">
                <img src="/views/assets/logo.png" alt="" class="logo">
            </div>
        </nav>
        <button type="button" class="button-one box-shadow-one LoginLink">Se Connecter</button>
    </header>
    <main></main>
<?php } ?>