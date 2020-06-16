<?php
session_start();
require_once "fonctions/bdd.php";
include_once "fonctions/blog.php";
$bdd = bdd();
if (!empty($_POST))
    $articles = recherche();
else
    $articles = articles();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SophieBlog - Accueil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <?php include "header.php" ?>
    <div class="container article">
        <div class="row">
            <form method="post" action="index.php">
                <div class="col-sm-10">
                    <input type="text" name="query" placeholder="Rechercher un article ..." value="<?php if (isset($_POST["query"])) echo $_POST["query"] ?>">
                </div>
                <div class="col-sm-2">
                    <input type="submit" value="OK!">
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST["query"])) :
        ?>
            <div class="row">
                <div class="col-xs-12">
                    <h1>Résultat de votre recherche avec "<?= $_POST["query"] ?>"</h1>
                </div>
            </div>
        <?php
        endif;
        ?>
        <div class="row">
            <?php
            foreach ($articles as $article) :
            ?>
                <div class="col-md-4 col-sm-6">
                    <article>
                        <img src="img/<?= $article["image"] ?>" alt="<?= $article["image"] ?>">
                        <p class="date">Posté le <time datetime="<?= $article["publication"] ?>"><?= formattage_date($article["publication"]) ?></time></p>
                        <h1><?= $article["titre"] ?></h1>
                        <p><?= $article["accroche"] ?>...</p>
                        <a href="article.php?id=<?= $article["id"] ?>">Lire l'article</a>
                    </article>
                </div>
            <?php
            endforeach;
            ?>
        </div>
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