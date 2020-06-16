<?php
function poster()
{
    global $bdd;

    extract($_POST);

    $validation = true;
    $erreurs = [];

    if (empty($titre) || empty($contenu)) {
        $validation = false;
        $erreurs[] = "Tous les champs sont obligatoires";
    }

    if (!isset($_FILES["file"]) or $_FILES["file"]["error"] > 0) {
        $validation = false;
        $erreurs[] = "Il faut indiquer un fichier";
    }

    if ($validation) {
        $image = basename($_FILES["file"]["name"]);

        move_uploaded_file($_FILES["file"]["tmp_name"], '../img/' . $image);

        $poster = $bdd->prepare("INSERT INTO articles(titre, accroche, contenu, image) VALUES(:titre, :accroche, :contenu, :image)");
        $poster->execute([
            "titre" => htmlentities($titre),
            "accroche" => substr(htmlentities($contenu), 0, 200),
            "contenu" => nl2br(htmlentities($contenu)),
            "image" => htmlentities($image)
        ]);

        unset($_POST["titre"]);
        unset($_POST["contenu"]);
    }

    return $erreurs;
}

function posts()
{
    global $bdd;

    $posts = $bdd->query("SELECT id, titre FROM articles ORDER BY id DESC");
    $posts = $posts->fetchAll();

    return $posts;
}

function post()
{
    global $bdd;

    $id = (int) $_GET["id"];

    $post = $bdd->prepare("SELECT titre, contenu FROM articles WHERE id = ?");
    $post->execute([$id]);
    $post = $post->fetch();

    return $post;
}

function supprimer()
{
    global $bdd;

    $id = (int) $_GET["id"];

    $image = $bdd->prepare("SELECT image FROM articles WHERE id = ?");
    $image->execute([$id]);
    $image = $image->fetch()["image"];

    unlink('../img/' . $image);

    $supprimer = $bdd->prepare("DELETE FROM articles WHERE id = ?");
    $supprimer->execute([$id]);
}

function modifier()
{
    global $bdd;

    $erreur = "";

    extract($_POST);

    $id = (int) $_GET["id"];

    if (!empty($titre) and !empty($contenu)) {
        $modifier = $bdd->prepare("UPDATE articles SET titre = :titre, accroche = :accroche, contenu = :contenu WHERE id = :id");
        $modifier->execute([
            "titre" => htmlentities($titre),
            "accroche" => substr(htmlentities($contenu), 0, 200),
            "contenu" => nl2br(htmlentities($contenu)),
            "id" => $id
        ]);
    } else
        $erreur .= "Les champs doivent contenir quelque chose";

    return $erreur;
}
