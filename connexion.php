<?php include_once 'templates/header.php' ?>
<?php include_once './helpers/session_helper.php' ?>

    <section class="connexion">
        <div class="connexion__container">
            <img src="assets/images/nav/logo.svg" alt="Logo telefoot" class="connexion__logo">
            <form action="./controllers/Users.php" method="post" class="form connexion__form">
                <input type="hidden" name="type" value="login">
                <div class="form__contents">
                    <div class="form__content">
                        <label for="email" class="form__content-label"></label>
                        <input type="email" name="email" id="email" class="form__content-input connexion__form-input" placeholder="Votre adresse email">
                    </div>
                </div>
                <div class="form__contents">
                    <div class="form__content">
                        <label for="password" class="form__content-label"></label>
                        <input type="password" name="password" id="password" class="form__content-input connexion__form-input" placeholder="Votre mot de passe">
                    </div>
                </div>
                <?php flash('login') ?>
                <input type="submit" value="Ouvrir une session" name="submit" class="form__submit connexion__form-submit">
            </form>
            <a href="reset.php" class="connexion__forget">Vous avez oublié votre mot de passe ?</a>
            <span class="connexion__separate"></span>
            <span class="connexion__instruction">Vous ne possédez toujours pas de compte ?</span>
            <a href="register.php" class="connexion__register">Créer un compte</a>
        </div>
    </section>

<?php include 'templates/footer.php' ?>