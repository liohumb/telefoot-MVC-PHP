<?php if (empty($_GET['selector']) || empty($_GET['validator'])) {
    echo 'Nous ne pouvons pas exécuter votre requête';
} else {
    $selector = $_GET['selector'];
    $validator = $_GET['validator'];

    if (ctype_xdigit($selector) && ctype_xdigit($validator)) { ?>

        <?php include 'templates/header.php' ?>
        <?php include_once './helpers/session_helper.php' ?>

        <section class="new">
            <div class="new__container">
                <img src="assets/images/nav/logo.svg" alt="Logo telefoot" class="connexion__logo">
                <h1 class="new__title">Nouveau mot de passe</h1>
                <form action="./controllers/Users.php" method="post" class="form connexion__form">
                    <input type="hidden" name="type" value="reset">
                    <input type="hidden" name="selector" value="<?= $selector ?>">
                    <input type="hidden" name="validator" value="<?= $validator ?>">
                    <div class="form__contents">
                        <div class="form__content">
                            <label for="password" class="form__content-label"></label>
                            <input type="password" name="password" id="password"
                                   class="form__content-input connexion__form-input" placeholder="Votre nouveau mot de passe">
                        </div>
                    </div>
                    <?php flash('new') ?>
                    <input type="submit" value="Envoyer" name="submit" class="form__submit connexion__form-submit">
                </form>
            </div>
        </section>

        <?php include 'templates/footer.php' ?>

    <?php } else {
        echo 'Nous ne pouvons pas exécuter votre requête';
    }
} ?>
