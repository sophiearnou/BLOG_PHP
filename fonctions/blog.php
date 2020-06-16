<?php
function articles()
{
    global $bdd;

    $articles = $bdd->query("SELECT id, titre, accroche, publication, image FROM articles ORDER BY id DESC");
    $articles = $articles->fetchAll();

    return $articles;
}

function article()
{
    global $bdd;

    $id = (int) $_GET["id"];

    $article = $bdd->prepare("SELECT id, titre, contenu, publication, image FROM articles WHERE id = ?");
    $article->execute([$id]);
    $article = $article->fetch();

    if (empty($article))
        header("Location: index.php");
    else
        return $article;
}

function formattage_date($publication)
{
    $publication = explode(" ", $publication);
    $date = explode("-", $publication[0]);
    $heure = explode(":", $publication[1]);

    $mois = ["", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

    $resultat = $date[2] . ' ' . $mois[(int) $date[1]] . ' ' . $date[0] . ' à ' . $heure[0] . 'h' . $heure[1];

    return $resultat;
}

function nb_commentaires()
{
    global $bdd;

    $id_article = (int) $_GET["id"];

    $nb_commentaires = $bdd->prepare("SELECT COUNT(*) FROM commentaires WHERE id_article = ?");
    $nb_commentaires->execute([$id_article]);
    $nb_commentaires = $nb_commentaires->fetch()[0];

    return $nb_commentaires;
}

function commentaires()
{
    global $bdd;

    $id_article = (int) $_GET["id"];

    $commentaires = $bdd->prepare("SELECT commentaires.*, membres.pseudo FROM commentaires INNER JOIN membres ON commentaires.id_membre = membres.id AND commentaires.id_article = ?");
    $commentaires->execute([$id_article]);
    $commentaires = $commentaires->fetchAll();

    return $commentaires;
}

function recherche()
{
    global $bdd;

    extract($_POST);

    $recherche = $bdd->prepare("SELECT id, titre, accroche, publication, image FROM articles WHERE titre LIKE :query OR contenu LIKE :query ORDER BY id DESC");
    $recherche->execute([
        "query" => '%' . $query . '%'
    ]);
    $recherche = $recherche->fetchAll();

    return $recherche;
}

function commentaires_user()
{
    global $bdd;

    $commentaires = $bdd->prepare("SELECT commentaires.*, articles.titre FROM commentaires INNER JOIN articles ON commentaires.id_article = articles.id AND commentaires.id_membre = ?");
    $commentaires->execute([$_SESSION["membre"]]);
    $commentaires = $commentaires->fetchAll();

    return $commentaires;
}

function commenter()
{
    if (isset($_SESSION["membre"])) {
        global $bdd;

        $erreur = "";

        extract($_POST);

        if (!empty($commentaire)) {
            $id_article = (int) $_GET["id"];

            $commenter = $bdd->prepare("INSERT INTO commentaires(id_membre, id_article, commentaire) VALUES(:id_membre, :id_article, :commentaire)");
            $commenter->execute([
                "id_membre" => $_SESSION["membre"],
                "id_article" => $id_article,
                "commentaire" => nl2br(htmlentities($commentaire))
            ]);
        } else
            $erreur .= "Vous devez écrire du texte";

        return $erreur;
    }
}
