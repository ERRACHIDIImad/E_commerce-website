<?php
if (!session_id())
    session_start();
if (isset($_SESSION['Nom']))
    header("Location:../Page_acceuil/Acceuil.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Inscription.css">
    <script src="inscription.js"></script>
    <title>Inscription</title>
</head>

<body>
    <header id="header">
        <img src="img/images.png" alt="Logo">
        <nav>
            <ul>
                <li><a href="../Page_acceuil/Acceuil.php">Accueil</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <article>
            <?php if (isset($_GET["message"])) {
                echo "<p id=\"errormsg\" style=\"width:100%;text-align:center; color:red;\" class=' inline_blocks'>" . $_GET["message"] . "</p>";
                unset($_GET["message"]);
            } ?>
            <div style=" margin:auto;">
                <div style="margin-left:auto;" class="img_div">
                    <div id="clients-infos">

                        <form id="myForm" name="form" action="../../Controller/Controller.php" method="post">
                            <div>
                                <div class="inline_blocks float"><label for="sexe">Sexe:</label></div>
                                <div class="inline_blocks float_right">
                                    <input type="radio" name="sexe" value="Man">Homme
                                    <input type="radio" name="sexe" value="Woman">Femme
                                </div>
                            </div>
                            <div>
                                <div class="inline_blocks float"><label for="nom">Nom:</label></div>
                                <div class="inline_blocks"> <input type="text" name="nom" id="nom">

                                </div>

                            </div>
                            <div>
                                <div class="inline_blocks float"><label for="prénom">Prénom:</label></div>
                                <div class="inline_blocks "> <input type="text" name="prénom" id="prénom"></div>
                            </div>

                            <div>
                                <div class="inline_blocks float"><label for="age">Age:</label></div>
                                <div class="inline_blocks"> <input type="text" name="age" id="age"></div>
                            </div>

                            <div>
                                <div class="inline_blocks float"><label for="pseudo">Pseudo:</label></div>
                                <div class="inline_blocks"> <input type="text" name="pseudo" id="pseudo"></div>
                            </div>

                            <div>
                                <div class="inline_blocks float"><label for="password">Mot de passe:</label></div>
                                <div class="inline_blocks"> <input type="password" name="password" id="password"></div>
                            </div>

                            <div>
                                <div class="inline_blocks float"><label for="password2">Mot de passe(confirmation):
                                </div>
                                <div class="inline_blocks"> <input type="password" name="password2" id="password2">
                                </div>
                            </div>
                            <div>
                                <div class="inline_blocks float"><label for="adresse">Adresse postale:
                                </div>
                                <div class="inline_blocks"> <input type="adresse" name="adresse" id="adresse">
                                </div>
                            </div>

                            <div>
                                <div class="inline_blocks float">
                                    <label for="Pays">Pays:</label>
                                </div>
                                <div class="inline_blocks">
                                    <select name="pays" id="Pays">
                                        <option>Sélectionnez votre pays de résidence</option>
                                        <option value="France">France</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Maroc">Maroc</option>
                                        <option value="Brésil">Brésil</option>
                                        <option value="Russie">Russie</option>
                                        <option value="Anglettere">Anglettere</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="emptyblocks"></div>
                                <div class="inline_blocks"><input type="checkbox" name="mailing" id="mailing"><label
                                        for="mailing">Je désire
                                        recevoir la
                                        newsletter
                                        chaque
                                        mois.</label>
                                </div>
                            </div>

                            <div>
                                <div class="emptyblocks"></div>
                                <div id="btns_block">
                                    <!-- User -->
                                    <input id="div_mrgn" class="button" type="button" value="S'inscrire"></input>
                                    <input id="div_mrgn2" class="button" type="reset"
                                        value="Vider le formulaire"></input>
                                </div>
                            </div>
                            <div>
                                <div class="emptyblocks"></div>
                                <div class="inline_blocks">
                                    Vous avez un compte: <a href="../Page_Login/Login.php">Connctez-vous</a>
                                </div>
                            </div>
                        </form>

        </article>
    </section>
    <footer>
        <p>Copyright 2022 - Site à propriété personnelle, tous droits résérvés</p>
    </footer>
</body>



</html>