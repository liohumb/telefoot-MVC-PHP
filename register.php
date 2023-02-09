<?php include 'templates/header.php' ?>

<section class="register">
    <div class="register__container">
        <h1 class="register__title">Créer un compte</h1>
        <form action="" method="post" class="form">
            <div class="form__contents">
                <div class="form__content">
                    <label for="username" class="form__content-label">Votre nom</label>
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
            <span class="form__instruction">Tout les champs sont obligatoires</span>
            <input type="submit" value="Envoyer" class="form__submit">
        </form>
    </div>
</section>

<?php include 'templates/footer.php' ?>