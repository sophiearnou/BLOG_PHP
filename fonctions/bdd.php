<?php
function bdd()
{
    try {
        $bdd = new PDO("mysql:dbname=blog;host=localhost", "root", "");
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }

    return $bdd;
}
