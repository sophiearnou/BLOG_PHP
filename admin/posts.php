<?php
require_once "../fonctions/bdd.php";
include_once "../fonctions/admin.php";
$bdd = bdd();
$posts = posts();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SophieBlog Admin - Posts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">
    <link rel="stylesheet" href="../main.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <a href="index.php">SophieBlog - admin</a>
                </div>
                <div class="col-sm-9">
                    <nav>
                        <ul>
                            <li><a href="index.php">Nouveau post</a></li>
                            <li><a href="posts.php">Anciens posts</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Anciens posts !</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table>
                    <?php
                    foreach ($posts as $post) :
                    ?>
                        <tr>
                            <td><?= $post["titre"] ?></td>
                            <td><a href="modifier.php?id=<?= $post["id"] ?>" class="glyphicon glyphicon-pencil"></a></td>
                            <td><a href="supprimer.php?id=<?= $post["id"] ?>" class="glyphicon glyphicon-remove"></a></td>
                        </tr>
                    <?php
                    endforeach
                    ?>
                </table>
            </div>
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