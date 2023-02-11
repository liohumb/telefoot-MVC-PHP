<?php include 'templates/header.php' ?>
<?php include_once './helpers/session_helper.php' ?>

<section class="reset">
    <div class="reset__container">
        <img src="assets/images/nav/logo.svg" alt="Logo telefoot" class="connexion__logo">
        <h1 class="reset__title">Réinitialiser le mot de passe</h1>
        <span class="reset__subtitle">Pour réinitialiser votre mot de passe, entrez l'e-mail de votre compte</span>
        <form action="./controllers/Resets.php" method="post" class="form connexion__form">
            <input type="hidden" name="type" value="send">
            <div class="form__contents">
                <div class="form__content">
                    <label for="email" class="form__content-label"></label>
                    <input type="email" name="email" id="email" class="form__content-input connexion__form-input" placeholder="Votre adresse email">
                </div>
            </div>
            <?php flash('reset') ?>
            <input type="submit" value="Envoyer" name="submit" class="form__submit connexion__form-submit">
        </form>
        <span class="connexion__instruction">Nous vous enverrons un lien pour réinitialiser votre mot de passe</span>
    </div>
</section>

<?php include 'templates/footer.php' ?>