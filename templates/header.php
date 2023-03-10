<?php session_start() ?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>TéléFoot</title>
        <!--boxicons-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!--stylesheet-->
        <link rel="stylesheet" href="assets/styles/css/style.css">
    </head>
    <body>
        <!--NAVBAR-->
        <header>
            <nav class="nav">
                <button class="nav__burger">
                    <i class='bx bx-menu'></i>
                </button>
                <a class="nav__logo" href="index.php">
                    <img alt="Logo télé foot" src="assets/images/nav/logo.svg">
                </a>
                <div class="nav__buttons">
                    <ul class="nav__menu">
                        <li>
                            <a class="nav__menu-link nav__menu-active" href="#home">Home</a>
                        </li>
                        <li>
                            <a class="nav__menu-link" href="#bar">Telefoot bar</a>
                        </li>
                    </ul>
                    <ul class="nav__connect">
                        <?php if (isset($_SESSION['username'])) { ?>
                            <li>
                                <span class="nav__connect-link nav__connect-name">Bienvenue <?= $_SESSION['username'] ?></span>
                            </li>
                            <li>
                                <a href="live.php" class="nav__connect-link nav__connect-connexion">Live</a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="register.php" class="nav__connect-link nav__connect-register">S'abonner</a>
                            </li>
                            <li>
                                <a href="connexion.php" class="nav__connect-link nav__connect-connexion">Se connecter</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
            <div class="nav__modal">
                <ul class="nav__modal-menu">
                    <li>
                        <a href="#home" class="nav__menu-link nav__menu-active">Home</a>
                    </li>
                    <li>
                        <a href="#bar" class="nav__menu-link">Telefoot bar</a>
                    </li>
                    <?php if (isset($_SESSION['username'])) { ?>
                        <li>
                            <a href="live.php" class="nav__menu-link">Live</a>
                        </li>
                        <li>
                            <a href="./controllers/Users.php?q=logout" class="nav__menu-link">Se déconnecter</a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="register.php" class="nav__menu-link">S'abonner</a>
                        </li>
                        <li>
                            <a href="connexion.php" class="nav__menu-link">Se connecter</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </header>

        <main class="main">