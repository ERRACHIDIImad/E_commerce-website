<?php if (!session_id())
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Acceuil.css">
    <script src="Accueil.js" defer></script>
    <title>E-shop techs</title>
</head>

<body>

    <header>
        <img src="img/images.png" alt="Logo">


        <nav>
            <img src="img/download.png" alt="filter">
            <!-- Client+user+admin+gestionnaire -->
            <select onchange="window.location.href=this.value" name="Filter" id="Filter">
                <option value="#">Catégories</option>
                <option value="./Acceuil.php?catég=All">All</option>
                <option value="./Acceuil.php?catég=Shoes">Shoes</a></option>
                <option value="./Acceuil.php?catég=Home">Home</option>
                <option value="./Acceuil.php?catég=Accessoires">Accessories</option>
                <option value="./Acceuil.php?catég=AutomotiveMotorcycle">Automotive&Motocycle</option>
                <option value="./Acceuil.php?catég=Men's clothing">Men's clothing</option>
                <option value="./Acceuil.php?catég=ConsummerElectronics">Electronics</option>
            </select>

            <li><input placeholder="Chercher articles" id="nomarticle" name="chercher" type="text"></li>
            <li id="input"><button id="chercher" value="Chercher">Chercher</button></li>

            <?php
            if (!isset($_SESSION["Id_user"]))
                echo "<label for=\"Login_signin\">Log in / Sign in</label>
             <select onchange=\"window.location.href=this.value\" name=\"Login_signin\" id=\"Login_signin\">
                <option value=\"#\">Select an option</a></option>
                <option value=\"../Page_Login/Login.php\">Log in</a></option>
                <option value=\"../Page_inscription/Inscription.php\">Sign in</a></option>
            </select>";

            if (isset($_SESSION["Id_user"]) && $_SESSION["Type"] == "Administrateur")
                echo "
            <li><a href=\"../Page_clients/Clients.php\">Clients</a></li>
            <li><a href=\"../Page_Ajouter_Article/Add_article.php\">Ajouter article</a></li>";

            if (isset($_SESSION["Id_user"]) && ($_SESSION["Type"] == "Administrateur" || $_SESSION["Type"] == "Gestionnaire"))
                echo "<li><a href=\"../Page_commandes/Commandes.php\">Commandes</a></li>";


            if (isset($_SESSION["Id_user"]) && ($_SESSION["Type"] == "Client"))
                echo "
            <li><a href=\"../Page_panier/Panier.php?c=" . $_SESSION["Id_client"] . "\">Votre panier</a></li>";



            if (isset($_SESSION["Id_user"])) {
                if ($_SESSION["Type"] == "Administrateur") {
                    echo "
                <div style=\"width:30%;\">
                <li style=\"float:right;\"><a href=\"../../Controller/Controller.php?var=logout\">Log out</a></li>
                <span style=\"margin-right:2%;float:right;\">" . $_SESSION['Nom'] . " " . $_SESSION['Prénom'] . "</span>
                </div>";
                }
                if ($_SESSION["Type"] == "Gestionnaire") {
                    echo "
                <div style=\"width:51%;\">
                <li style=\"float:right;\"><a href=\"../../Controller/Controller.php?var=logout\">Log out</a></li>
                <span style=\"float:right;margin-right:1.5%;\">" . $_SESSION['Nom'] . " " . $_SESSION['Prénom'] . "</span>
                </div>
                ";
                }
                if ($_SESSION["Type"] == "Client") {
                    echo "
                <div style=\"width:50%;\">
                <li style=\"float:right;\"><a href=\"../../Controller/Controller.php?var=logout\">Log out</a></li>
                <span style=\"float:right;margin-right:1.5%;\">" . $_SESSION['Nom'] . " " . $_SESSION['Prénom'] . "</span>
                </div>
                ";
                }
            }



            ?>
        </nav>

    </header>



    <main>

        <section style="overflow:scroll;height: 100em;">
            <?php if (isset($_SESSION["Id_user"]) && $_SESSION["Type"] == "Administrateur")
                echo "
            <div>
            <form id=\"addcatégform\" method=\"post\"  action=\"../../Controller/Controller.php\">
            <input  style=\"float:right;margin-right:5.5%;\" id=\"addcatégbtn\" type=\"button\" class=\"button\" onclick=\"addCatég();\"   \" name=\"add_categ_btn\" value=\"Ajouter\"></input>
            <input style=\"float:right;\ margin-right:2%;\"   placeholder=\"ajouter une catégorie\" type=\"text\" name=\"add_categ\" id=\"add_categ\">
               
            </div><br><br>"; ?>
            <?php
            if (isset($_GET["addmsg"]))
                if ($_GET["addmsg"] == "Un article a bien été ajouté dans votre panier")
                    echo "<div>
                <p
                    style=\"font-family:'Times New Roman', Times, serif;margin-left:47%;margin-bottom:0%;color:rgb(244, 214, 255)\">" .
                        $_GET["addmsg"] . "</p><br>
            </div>";
                else {
                    echo "<div>
                <p
                    style=\"font-family:'Times New Roman', Times, serif;margin-left:47%;margin-bottom:0%;color:red\">" .
                        $_GET["addmsg"] . "</p><br>
            </div>";
                }

            require_once "../../DaoAndModel/Model.php";
            $Articles = Articles();

            if (isset($_GET["msg"])) {
                if ($_GET["msg"] == "Suppression réussie") {
                    echo "<div>
                                <p style=\"font-family:'Times New Roman', Times, serif;margin-left:47%;margin-bottom:0%;color:rgb(244, 214, 255)\">" .
                        $_GET["msg"] . "</p><br>
                          </div>";
                } else {
                    echo "<div><p style=\"font-family:'Times New Roman', Times, serif;margin-left:47%;margin-bottom:0%;color:red\">" .
                        $_GET["msg"] . "</p><br> 
                          /div>";


                }

                unset($_GET["msg"]);
            } ?>

            <?php if (!empty($Articles)): ?>
                <?php
                if (isset($_SESSION["article"])) {
                    $article_infos = $_SESSION["article"][0];
                    unset($_SESSION["article"]);
                    $Id_crticle = $article_infos["id_article"];
                    ?>

                    <div class="article">
                        <div class="img_division">
                            <?php $base64Image = base64_encode($article_infos['Photo']); ?>
                            <img class="img_div" src="data:image/jpeg;base64,<?= $base64Image ?>" alt="photo">
                        </div>
                        <hr>
                        <div>
                            <div class="label_div inline_blocks"><label class="color_labels" for="nom">Nom :</label></div>
                            <p class="inline_blocks " id="nom" name="nom">
                                <?= $article_infos["NomDésignation"] ?>
                            </p>
                        </div>
                        <div>
                            <div class="label_div inline_blocks"><label class="color_labels" for="vendeur">Vendeur:
                                </label></div>
                            <p class="inline_blocks " id="vendeur" name="vendeur">
                                <?= $article_infos["Marque"] ?>
                            </p>
                        </div>
                        <div>
                            <div class="label_div inline_blocks"><label class="color_labels" for="prix">Prix: </label></div>
                            <p class="inline_blocks " id="prix" name="prix">
                                <?= $article_infos["Prix_unitaire"] ?>Dh
                            </p>
                        </div>
                        <!--User + Client + getionnaire + Admin-->
                        <button class="button add_btn" name="détails"
                            onclick="location.href='../Page_article/article.php?article=<?= $Id_crticle ?>'">Détails</button>
                        <!-- client -->
                        <?php

                        if (isset($_SESSION["Id_user"]) && $_SESSION["Type"] == "Client") {
                            require_once "../../DaoAndModel/Model.php";
                            $Client = ClientData($_SESSION["Id_client"])[0];
                            if (!$Client["Commande effectuée"])
                                echo " <button class=\"button add_btn add_btns\" onclick=\"addArticleToPanel(" . $_SESSION["Id_client"] . ",$Id_crticle);\" name=\"ajouter_panier\">Ajouter au panier</button>";
                            echo " <button class=\"button add_btn purchase_btns\"  name=\"acheter\">Acheter</button>";
                        }
                        if (isset($_SESSION["Id_user"]) && ($_SESSION["Type"] == "Administrateur"))
                            echo "
                            <button class=\"button delete_btn\" name=\"Supprimer\"
                            onclick=\"delete_article_admin($Id_crticle);\">Supprimer</button>"; ?>

                    </div>


                    <?php
                } else {
                    require_once "../../DaoAndModel/Model.php";

                    if (isset($_GET["catég"]) && $_GET["catég"] != "All") {
                        $i = 0;
                        foreach ($Articles as $article) {
                            if ($article["NomCatégorie"] == $_GET["catég"]) {
                                $Id_crticle = $article["id_article"];
                                if ($i % 3 == 0)
                                    echo " <div class=\"flexH\">";
                                $i++; ?>


                                <div class="article">
                                    <input type="hidden" name="id_article" value="<?= $Id_crticle ?>">
                                    <div class="img_division">
                                        <?php $base64Image = base64_encode($article['Photo']); ?>
                                        <img class="img_div" src="data:image/jpeg;base64,<?= $base64Image ?>" alt="">
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="label_div inline_blocks"><label class="color_labels" for="nom">Nom :</label></div>
                                        <p class="inline_blocks " id="nom" name="nom">
                                            <?= $article["NomDésignation"] ?>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="label_div inline_blocks"><label class="color_labels" for="vendeur">Vendeur:
                                            </label></div>
                                        <p class="inline_blocks " id="vendeur" name="vendeur">
                                            <?= $article["Marque"] ?>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="label_div inline_blocks"><label class="color_labels" for="prix">Prix: </label></div>
                                        <p class="inline_blocks " id="prix" name="prix">
                                            <?= $article["Prix_unitaire"] ?>Dh
                                        </p>
                                    </div>
                                    <!--User + Client + getionnaire + Admin-->
                                    <button class="button add_btn" name="détails"
                                        onclick="location.href='../Page_article/article.php?article=<?= $Id_crticle ?>'">Détails</button>
                                    <!-- client -->
                                    <?php if (isset($_SESSION["Id_user"]) && $_SESSION["Type"] == "Client") {
                                        $Client = ClientData($_SESSION["Id_client"])[0];
                                        if (!$Client["Commande effectuée"])
                                            echo " <button class=\"button add_btn add_btns\" onclick=\"addArticleToPanel(" . $_SESSION["Id_client"] . ",$Id_crticle);\" name=\"ajouter_panier\">Ajouter au panier</button>";
                                        echo " <button class=\"button add_btn purchase_btns\"  name=\"acheter\">Acheter</button>";
                                    }

                                    if (isset($_SESSION["Id_user"]) && ($_SESSION["Type"] == "Administrateur"))
                                        echo "
    <button class=\"button delete_btn\" name=\"Supprimer\"
    onclick=\"delete_article_admin($Id_crticle);\">Supprimer</button>"; ?>
                                </div>
                                <?php
                            }
                            if ($i % 3 == 0) {
                                echo "</div>";
                            }
                        }
                    }
                    
                    
                    
                    else {
                        foreach (Catégories() as $catégorie) {
                            $Id_catégorie = $catégorie["Id_catégorie"];
                            $i = 0;
                            ?>
                            <div>
                                <h2>
                                    <?= $catégorie["NomCatégorie"] ?>
                                </h2>
                                <?php if (isset($_SESSION["Id_user"]) && $_SESSION["Type"] == "Administrateur") {
                                    echo "<button class=\"button supprimer_categ\"  onclick=\"delete_catégorie_admin($Id_catégorie);\" name=\"supprimer_categ\">Supprimer</button>";
                                } ?>
                            </div>
                            <?php
                            foreach ($Articles as $article) {

                                if ($article["NomCatégorie"] == $catégorie["NomCatégorie"]) {
                                    $Id_crticle = $article["id_article"];
                                    if ($i % 3 == 0)
                                        echo " <div class=\"flexH\">";
                                    $i++; ?>


                                    <div class="article">
                                        <input type="hidden" name="id_article" value="<?= $Id_crticle ?>">
                                        <div class="img_division">
                                            <?php $base64Image = base64_encode($article['Photo']); ?>
                                            <img class="img_div" src="data:image/jpeg;base64,<?= $base64Image ?>" alt="">
                                        </div>
                                        <hr>
                                        <div>
                                            <div class="label_div inline_blocks"><label class="color_labels" for="nom">Nom :</label></div>
                                            <p class="inline_blocks " id="nom" name="nom">
                                                <?= $article["NomDésignation"] ?>
                                            </p>
                                        </div>
                                        <div>
                                            <div class="label_div inline_blocks"><label class="color_labels" for="vendeur">Vendeur:
                                                </label></div>
                                            <p class="inline_blocks " id="vendeur" name="vendeur">
                                                <?= $article["Marque"] ?>
                                            </p>
                                        </div>
                                        <div>
                                            <div class="label_div inline_blocks"><label class="color_labels" for="prix">Prix: </label></div>
                                            <p class="inline_blocks " id="prix" name="prix">
                                                <?= $article["Prix_unitaire"] ?>Dh
                                            </p>
                                        </div>
                                        <!--User + Client + getionnaire + Admin-->
                                        <input  type="button" class="button add_btn" name="détails"
                                            onclick="location.href='../Page_article/article.php?article=<?= $Id_crticle ?>'" value="Détails"></input>
                                        <!-- client -->
                                        <?php
                                        if (isset($_SESSION["Id_user"]) && $_SESSION["Type"] == "Client") {
                                            require_once "../../DaoAndModel/Model.php";
                                            $Client = ClientData($_SESSION["Id_client"])[0];
                                            if (!$Client["Commande effectuée"])
                                                echo " <button class=\"button add_btn add_btns\" onclick=\"addArticleToPanel(" . $_SESSION["Id_client"] . ",$Id_crticle);\" name=\"ajouter_panier\">Ajouter au panier</button>";
                                            echo " <button class=\"button add_btn purchase_btns\"  name=\"acheter\">Acheter</button>";
                                        }

                                        if (isset($_SESSION["Id_user"]) && ($_SESSION["Type"] == "Administrateur"))
                                            echo "
                                                  <button class=\"button delete_btn\" name=\"Supprimer\"
                                                  onclick=\"delete_article_admin($Id_crticle);\">Supprimer</button>"; ?>
                                    </div>
                                    <?php
                                }
                                if ($i % 3 == 0) {
                                    echo "</div>";
                                }
                            }

                        }

                    }

                } ?>
            <?php endif; ?>


            <hr>


        </section>
    </main>
    <footer>
        <p>Copyright 2022 - Site à propriété personnelle, tous droits résérvés</p>
    </footer>
</body>

</html>