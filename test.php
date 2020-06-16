<?php
// $chiffre = 8;
// $tableau = ["valeur1", 2, 'valeur2'];

// $chaine = "bonjour ";
// $chaine2 = "moi";
// $chaine .=  $chaine2 . " !";
// echo $chaine;

// $articles = [
//     [
//         "id" => 1,
//         "titre" => "Article 1",
//         "accroche" => "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit similique eum sequi! Culpa quam earum, iusto atque incidunt porro ad quae sint, doloremque molestiae qui recusandae repudiandae sequi eius eos.</p>",
//         "publication" => "2020-06-05 14:24",
//         "image" => "https://placeimg.com/640/480/people"
//     ],
//     [
//         "id" => 2,
//         "titre" => "Article 2",
//         "accroche" => "<p>Lorem ipsum dolor sit amet. Fugit similique eum sequi! Culpa quam earum, iusto atque incidunt porro ad quae sint, doloremque molestiae qui recusandae repudiandae sequi eius eos.</p>",
//         "publication" => "2020-06-05 15:24",
//         "image" => "https://placeimg.com/640/480/people"
//     ],
//     [
//         "id" => 3,
//         "titre" => "Article 3",
//         "accroche" => "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit similique eum sequi! Culpa quam earum, iusto atque incidunt porro ad quae sint.</p>",
//         "publication" => "2020-06-05 16:24",
//         "image" => "https://placeimg.com/640/480/people"
//     ]
// ];

// foreach ($articles as $article) {
//     if($article["id"] == 1)
//     continue;
//     echo $article["titre"] . '</br>';
// }
// ------------------------------------
// empty() ->determine si variable vide
// SI POST n'est pas vide (!) FORMULAIRE PAS ENVOYE
if (!empty($_POST)) {
    echo 'formulaire a été envoyé';
}

// isset -> deternime si variable est définie est different de null
// utiliser pour savoir si une variable existe
// if (isset($_SESSION["membre"])) {
//     echo "Vous êtes connecté";
// } else {
//     header("location: index.php"); //header pour rediriger vers une page
// }

// unset ->détuire une variable
// utiliser pour vider les champ ou supprimer les donner de connexion


// FILTER_VALIDATE_ permet de faire des verification

// $email = "sophiearnou@yahoo;fr";
// if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     echo "adresse correcte";
// } else {
//     echo "adresse incorrecte";
// }

// -----------------------------
// fonction date
// $publication = date("Y-m-d H:i");
// echo $publication;

// -------------------------
// fonction print_r utiliser pour afficher les données avant de les mettre en page
// print_r($articles); //on affiches tout le contenu du tableau

//------------------------------------
// htmlentities pour la securité failes xss tranforme le code en text
// $commentaire = htmlentities("<script>alert(\"hello world\")</script>");
// echo $commentaire;

//-------------------------------
// strlen calcule la taille dela chaine de caractere
//s'utilise sur les formulaire
// $chaine = "bonjour tous le monde";
// if (strlen($chaine) < 50) {
//     //trop court
// } elseif (strlen($chaine) > 200) {
//     //trop long
// }
//--------------------------------
// password_verify() verifie qu'un mot de passe correspond à un hachage
// password_hash hachage de mot de passe
// $password = "azerty";
// $password = password_hash($password, PASSWORD_DEFAULT);

// if (password_verify("azerty", $password)) {
//     echo "password ok";
// }
//----------------------------------------
// fonction mail permet d'envoyer des mail via php

// $destinataire = "sophiearnou@yahoo.fr";
// $sujet = "Test email avec PHP";
// $message = "<h1>Bonjour</h1>";
// // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
// $headers = 'MIME-Version: 1.0' . "\r\n";
// $headers .=
//     'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// $headers .= "From:sophie <contact@yahoo.fr>";

// mail($destinataire, $sujet, $message, $headers);

$dsn = 'mysql:dbname=blog;host=localhost';
$user = 'root';
$password = '';
//essai de te connecter à la base de donnée
//si soucis affiche un messsage
try {
    $bdd = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

//affiche mes articles
// $articles = $bdd->query("SELECT * FROM articles");
//fetch select 1 à 1 mes articles
// while ($article = $articles->fetch()) {
//     //affiche mes articles
//     echo $article["titre"] . '<br>';
// }

// //pour fetchall on utilise foreach
// $articles = $articles->fetchAll();

// foreach ($articles as $article) {
//     echo $article["titre"] . '<br>';
// }


// ----requete avec variable donc prepare
