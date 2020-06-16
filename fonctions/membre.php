<?php
function inscription()
{
    global $bdd;

    extract($_POST);

    $validation = true;
    $erreur = [];
    //si speudo OU email OU emailconf OU password OU passwordconf
    if (empty($pseudo) || empty($email) || empty($emailconf) || empty($password) || empty($passwordconf)) {
        $validation = false;
        $erreur[] = "Tous les champs sont obligatoires";
    }

    if (existe($pseudo)) {
        $validation = false;
        $erreur[] = "Ce pseudo est déjà pris";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validation = false;
        $erreur[] = "L'adresse e-mail n'est pas valide";
    } elseif ($emailconf != $email) {
        $validation = false;
        $erreur[] = "L'adresse e-mail de confirmation est incorrecte";
    }

    if ($passwordconf != $password) {
        $validation = false;
        $erreur[] = "Le mot de passe de confirmation est incorrect";
    }

    if ($validation) {
        $inscription = $bdd->prepare("INSERT INTO membres(pseudo, email, password) VALUES(:pseudo, :email, :password)");
        $inscription->execute([
            "pseudo" => htmlentities($pseudo),
            "email" => htmlentities($email),
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);

        unset($_POST["pseudo"]);
        unset($_POST["email"]);
        unset($_POST["emailconf"]);
    }

    return $erreur;
}

function existe($pseudo)
{
    global $bdd;

    $resultat = $bdd->prepare("SELECT COUNT(*) FROM membres WHERE pseudo = ?");
    $resultat->execute([$pseudo]);
    $resultat = $resultat->fetch()[0];

    return $resultat;
}

function connexion()
{
    global $bdd;

    extract($_POST);

    $erreur = "Les identifiants sont erronés";

    $connexion = $bdd->prepare("SELECT id, password FROM membres WHERE pseudo = ?");
    $connexion->execute([$pseudo]);
    $connexion = $connexion->fetch();

    //verifie si le mot de passe et le même que dans la base de donnée
    if (password_verify($password, $connexion["password"])) {
        $_SESSION["membre"] = $connexion["id"];
        header("Location: compte.php");
    } else
        return $erreur;
}

function deconnexion()
{
    unset($_SESSION["membre"]);
    session_destroy();
    header("Location: connexion.php");
}

function infos()
{
    global $bdd;

    $membre = $bdd->prepare("SELECT pseudo, email FROM membres WHERE id = ?");
    $membre->execute([$_SESSION["membre"]]);
    $membre = $membre->fetch();

    return $membre;
}
