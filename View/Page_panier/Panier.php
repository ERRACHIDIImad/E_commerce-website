<?php if (!session_id())
    session_start();

if (!isset($_SESSION["Type"]))
    header("Location:../Page_acceuil/Acceuil.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Panier.css">
    <script src="Panier.js" defer></script>
    <title>Panier</title>
</head>

<body>

    <header>
        <img src="img/images.png" alt="Logo">
        <nav>
            <ul>
                <li><a href="../Page_acceuil/Acceuil.php">Accueil</a></li>

                <?php if ($_SESSION["Type"] == "Gestionnaire" || $_SESSION["Type"] == "Administrateur"): ?>
                    <li><a href="../Page_commandes/Commandes.php">Commandes</a></li>
                <?php endif; ?>
                <?php if ($_SESSION["Type"] == "Client"): ?>
                    <div style="display:inline;margin-right:10%;">
                        <p></p>
                    </div>
                <?php endif; ?>
                <div Style="width:80%;" class="inline_blocks">
                    <li style="margin-right:2%;float:right;" class="inline_blocks "><a
                            href="../../Controller/Controller.php?var=logout\">Log out</a></li>
                    <span style="margin-right:1.5%;float:right;">
                        <?= $_SESSION["Nom"] . " " . $_SESSION["Prénom"] ?>
                    </span>
                </div>
            </ul>

        </nav>
    </header>



    <main>
        <div>
            <?php
            if (isset($_GET["msg"])) {
                if (
                    $_GET["msg"] == "Le serveur ne réponds pas,Veuillez réessayer plud tard"
                ) {
                    echo "<div>
                                      <p style=\"font-family:'Times New Roman', Times, serif;margin-left:37%;margin-bottom:0%;color:red\">" .
                        $_GET["msg"] . "</p>
                                  </div>";
                } else {
                    echo "<div>
                                      <p style=\"font-family:'Times New Roman', Times, serif;margin-left:47%;margin-bottom:0%;color:rgb(244, 214, 255)\">" .
                        $_GET["msg"] . "</p><br>
                                 </div>";
                }
                unset($_GET["msg"]);
            }
            require_once "../../DaoAndModel/Model.php";
            $Panier = Panier($_GET["c"]);
            if (!empty($Panier)) {
                $Commande = $Panier[0]["commande effectuée"];

                ?>

                <?php if ($_SESSION["Type"] == "Gestionnaire" || $_SESSION["Type"] == "Administrateur"): ?>
                    <button id="div_mrgn2" class="button" onclick="Validate(<?= $_GET['c'] ?>);">valider</button><br><br><br>

                <?php endif; ?>

                <?php if ($_SESSION["Type"] == "Client"): ?>

                    <div>
                        <?php if (!$Commande): ?>
                            <button id="div_mrgn" class="button" onclick="paiement();" name="acheter">Acheter</button>
                            <button id="div_mrgn2" class="button" onclick="Commander(<?= $_SESSION['Id_client'] ?>);"
                                name="acheter">Commander</button>
                        <?php endif; ?>
                        <h2>Votre panier :</h2>
                    </div>
                <?php endif; ?>
            </div>



            <section style="overflow:scroll;height: 70em;">


                <?php
                require_once "../../DaoAndModel/Model.php";
                $Panier = Panier($_GET["c"]);
                $Commande = $Panier[0]["commande effectuée"];

                ?>

                <div class="flexH">





                    <?php if (!empty($Panier)): ?>
                        <?php foreach ($Panier as $article): ?>



                            <div class="article">
                                <div class="image">
                                    <?php $base64Image = base64_encode($article["photo"]); ?>
                                    <img class="img_div" src="data:image/jpeg;base64,<?= $base64Image ?>" alt="photo">
                                    <hr>
                                </div>
                                <div>
                                    <div class="label_div inline_blocks"><label class="color_labels" for="nom">Nom
                                            d'article:</label></div>
                                    <p class="inline_blocks " id="nom" name="nom">
                                        <?= $article["Nomdésignation"] ?>
                                    </p>
                                </div>
                                <div>
                                    <div class="label_div inline_blocks"><label class="color_labels" for="prix">Prix: </label></div>
                                    <p class="inline_blocks " id="prix" name="prix">
                                        <?= $article["prix_unitaire"] ?>Dh
                                    </p>
                                </div>
                                <div>
                                    <div class="label_div inline_blocks"><label class="color_labels" for="quantité">Quantité:
                                        </label></div>
                                    <p class="inline_blocks " id="quantité" name="quantité">
                                        <?= $article["Quantité"] ?>
                                    </p>
                                </div>


                                <?php if ($_SESSION["Type"] == "Client" && !$Commande) {
                                    echo "
                                <button class=\"button article_btns\" onclick=\"Modify(" . $_SESSION['Id_client'] . ". , " . $article['id_article'] . ");\" name=\"Modifier\">Modifier quantité</button>
                                <button class=\"button article_btns2\" onclick=\"Supprimer(" . $_SESSION['Id_client'] . ". , " . $article['id_article'] . ");\" name=\"Supprimer\">Supprimer</button>";
                                } ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif;
            } ?>
            </div>


        </section>


    </main>
    <footer>
        <p>Copyright 2022 - Site à propriété personnelle, tous droits résérvés</p>
    </footer>
</body>



</html>