<?php
session_start();
if (isset($_SESSION["membre"]))
    header("Location: compte.php");
require_once "fonctions/bdd.php";
include_once "fonctions/membre.php";
$bdd = bdd();
if (!empty($_POST))
    $erreurs = inscription();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SophieBlog - Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <?php include "header.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3">
                <h1>Inscription sur SophieBlog !</h1>
            </div>
        </div>
        <form method="post" action="inscription.php">
            <?php
            if (isset($erreurs)) :
                if ($erreurs) :
                    foreach ($erreurs as $erreur) :
            ?>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="message erreur"><?= $erreur ?></div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                else :
                    ?>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="message confirmation">Votre inscription a bien été prise en compte !</div>
                        </div>
                    </div>
            <?php
                endif;
            endif;
            ?>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="text" name="pseudo" placeholder="Pseudo *" value="<?php if (isset($_POST["pseudo"])) echo $_POST["pseudo"] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="text" name="email" placeholder="Adresse e-mail *" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="text" name="emailconf" placeholder="Vérification de l'e-mail *" value="<?php if (isset($_POST["emailconf"])) echo $_POST["emailconf"] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="password" name="password" placeholder="Mot de passe *">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="password" name="passwordconf" placeholder="Vérification du mot de passe *">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="submit" value="M'inscrire!">
                </div>
            </div>
        </form>
        <footer>
            <div class="row">
                <div class="col-xs-12">
                    <a href="contact.php">Contact</a> - <a href="mentions.php">Mentions légales</a> - <a href="https://www.facebook.com/infoprog.tuto">Facebook</a>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>