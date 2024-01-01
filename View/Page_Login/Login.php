<?php if (!session_id())
    session_start();

if (isset($_SESSION["Nom"]))
    header("Location:../Page_acceuil/Acceuil.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <script src="Login.js"></script>
    <title>Authentification</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="../Page_acceuil/Acceuil.php">Accueil</a></li>
        </ul>
    </nav>



    <main>
        <img id="logo_div" src="img/images.png" alt="">
        <section>
            <article>
                <div style="margin:auto;">
                    <div style="margin-left:auto;" class="img_div">
                        <form id='myForm' method="post" name="form" action="../../Controller/Controller.php">
                            <div>
                                <div class="inline_blocks float"><label for="pseudo">Pseudo:</label></div>
                                <div style="margin-right:-3%;" class="inline_blocks"> <input type="text" name="pseudo"
                                        id="pseudo"></div>
                                <div style="width: 35.5% ; " class="inline_blocks">

                                    <?php if (isset($_GET["returnmsg"]))
                                        echo "<p id=\"signinsucced\" style='color:lightgreen;' class=' inline_blocks'>" . $_GET["returnmsg"] . "</p>";
                                    unset($_GET["returnmsg"]); ?>

                                    <?php if (isset($_GET["message"]))
                                        echo "<p  id=\"donneesincorrectes\" style='color:red;' class=' inline_blocks'>" . $_GET["message"] . "</p>";
                                    unset($_GET["message"]); ?>
                                </div>

                                <div>
                                    <div class="inline_blocks float"><label for="password">Mot de passe:</label>
                                    </div>
                                    <div class="inline_blocks"> <input type="password" name="password" id="password">
                                    </div>
                                </div>
                                <div>
                                    <div class="emptyblocks"></div>
                                    <div id="btns_block">
                                        <!--  Client+Gestionnaire+Admin -->
                                        <input id="div_mrgn" class="button" type="button" name="submit"
                                            value="Se connecter"></input>
                                        <input id="div_mrgn2" class="button" type="reset" value="Vider le formulaire" />
                                    </div>
                                </div>
                                <div>
                                    <div class="emptyblocks"></div>
                                    <div class="inline_blocks">
                                        Vous n'avez pas de compte: <a href="../Page_inscription/Inscription.php">Créer
                                            un nouveau compte</a>
                                    </div>
                                </div>

                        </form>
            </article>
        </section>
    </main>
    <footer>
        <p>Copyright 2022 - Site à propriété personnelle, tous droits résérvés</p>
    </footer>
</body>



</html>