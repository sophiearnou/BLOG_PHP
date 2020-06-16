<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <a href="index.php">SophieBlog</a>
            </div>
            <div class="col-sm-10">
                <nav>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <?php
                        if (isset($_SESSION["membre"])) :
                        ?>
                            <li><a href="compte.php">Mon compte</a></li>
                            <li><a href="deconnexion.php">Déconnexion</a></li>
                        <?php
                        else :
                        ?>
                            <li><a href="connexion.php">Connexion</a></li>
                            <li><a href="inscription.php">Inscription</a></li>
                        <?php
                        endif;
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>