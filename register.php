<?php include_once 'templates/header.php' ?>
<?php include_once './helpers/session_helper.php' ?>

<section class="register">
    <div class="register__container">
        <h1 class="register__title">Créer un compte</h1>
        <form action="./controllers/Users.php" method="post" class="form">
            <input type="hidden" name="type" value="register">
            <div class="form__contents">
                <div class="form__content">
                    <label for="username" class="form__content-label">Votre nom d'utilisateur</label>
                    <input type="text" name="username" id="username" class="form__content-input">
                </div>
                <div class="form__content">
                    <label for="email" class="form__content-label">Email</label>
                    <input type="email" name="email" id="email" class="form__content-input">
                </div>
            </div>
            <div class="form__contents">
                <div class="form__content">
                    <label for="password" class="form__content-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form__content-input">
                </div>
                <div class="form__content">
                    <label for="passwordConfirm" class="form__content-label">Confirmer le mot de passe</label>
                    <input type="password" name="passwordConfirm" id="passwordConfirm" class="form__content-input">
                </div>
            </div>
            <?php flash('register') ?>
            <input type="submit" value="Envoyer" name="submit" class="form__submit">
        </form>
    </div>
</section>

<?php include 'templates/footer.php' ?>