<?php
if (!session_id())
    session_start();
if (!isset($_SESSION['Type']) || $_SESSION['Type'] != "Administrateur")
    header("Location:../Page_acceuil/Acceuil.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Add_article.css">
    <script src="Add_article.js"></script>
    <title>Ajouter article</title>
</head>

<body>
    <header>
        <img src="img/images.png" alt="Logo">
        <div class="inline_blocks ">
                    
                    </label>
                </div>
        <nav >

            <ul>
                <li><a href="../Page_acceuil/Acceuil.php">Accueil</a></li>
                <li><a href="../Page_clients/Clients.php">Clients</a></li>
                <li><a href="../Page_commandes/Commandes.php">Commandes</a></li>
                <li style="margin-right:2%;float:right;"><a href="../../Controller/Controller.php?var=logout">Log out</a></li>
                <span style="margin-right:1%;float:right;"><?= $_SESSION["Nom"] . " " . $_SESSION["Prénom"] ?></span>
            </ul>
        </nav>
    </header>

    <?php
    if (isset($_GET["msg"])) {
        if ($_GET["msg"] == "Un problème est survenu lors de l'opération, essayer plus tard") {
            echo "<p  style=\"color:red\" class=\"returns\">" . $_GET["msg"] . "</p>";
        } else
            echo "<p class=\"returns\">" . $_GET["msg"] . "</p>";
        unset($_GET["msg"]);
    }
    ?>

    <section>
        <article>
            <div style="margin:auto;">
                <div style="margin-left:auto;" class="img_div">
                    <div id="clients-infos">

                        <form id='form' name="form" action="../../Controller/Controller.php" method="post"
                            enctype="multipart/form-data">
                            <div>
                                <div class="inline_blocks float">
                                    <label for="nom">Nom de désignation*:</label>
                                </div>
                                <div class="inline_blocks">
                                    <input type="text" name="nom" id="nom">
                                </div>
                                <div class="inline_blocks">
                                    <label for="photo">Photo*:</label>
                                </div>
                                <div class="inline_blocks">
                                    <input type="file" id="photo" name="photo" accept=".png, .jpg, .jpeg, .webm, .gif">
                                </div>
                            </div>
                            <div>
                                <div class="inline_blocks float"><label for="prix">Prix unitaire*:</label></div>
                                <div class="inline_blocks"> <input type="text" name="prix" id="prix"></div>
                            </div>

                            <div>
                                <div class="inline_blocks float"><label for="catégorie">Catégorie*:</label></div>
                                <div class="inline_blocks"> <input type="text" name="catégorie" id="catégorie"></div>
                            </div>

                            <div>
                                <div class="inline_blocks float"><label for="vendeur">Vendeur*:</label></div>
                                <div class="inline_blocks"> <input type="text" name="vendeur" id="vendeur"></div>
                            </div>
                            <div>
                                <div class="inline_blocks float"><label for="description">Description:</label></div>
                                <div class="desc_div inline_blocks"> <textarea name="description"
                                        id="description"></textarea></div>
                            </div>

                    </div>


                    <div>
                        <div class="emptyblocks"></div>
                        <div id="btns_block">
                            <!-- admin -->
                            <input id="div_mrgn" class="button" type="button" value="Ajouter" name="submit"></input>
                            <input id="div_mrgn2" class="button" type="reset" value="Vider le formulaire">
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