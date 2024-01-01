<?php if (!session_id())
    session_start();

if (!isset($_SESSION["Type"]) || ($_SESSION["Type"] != "Administrateur"))
    header("Location:../Page_acceuil/Acceuil.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Clients.css">
    <script src="Clients.js" defer></script>
    <title>Clients</title>
</head>

<body>

    <header>
        <img src="img/images.png" alt="Logo">


        <nav>
            
            <li><a href="../Page_acceuil/Acceuil.php">Acceuil</a></li>
            <img src="img/download.png" alt="filter">





            <select name="age" id="ageselect">
                <option value="#">Age</option>

                <option value="5/12">&le; 12 and &gt; 5</option>
                <option value="12/18">&le; 18 and &gt; 12</option>
                <option value="18/30">&le; 30 and &gt; 18</option>
                <option value="30/60">&le; 60 and &gt; 30</option>
            </select>


            <select name="sexe" id="sexeselect">
                <option value="#">Sexe</option>

                <option value="All">All</option>
                <option value="Man">Homme</option>
                <option value="Woman">Femme</option>
            </select>

            <button style="margin-right:1%;" class="button" onclick="UpdateSearch();" >Filter</button>

<div Style="width:68%;" class="inline_blocks">
             <li style="margin-right:2%;float:right;" class="inline_blocks "><a  href="../../Controller/Controller.php?var=logout\">Log out</a></li>
             <span style="margin-right:2%;float:right;"><?= $_SESSION["Nom"] . " " . $_SESSION["Prénom"] ?></span>
             </div>  </nav>
    </header>



    <main>
        <section style="overflow:scroll;height: 100em;">
            <?php
            require_once "../../DaoAndModel/Model.php";
            $Clients = Clients();


            if (isset($_GET["msg"])) {
                if ($_GET["msg"] == "Suppression réussie") {
                    echo
                        "<div>
                            <p style=\"font-family:'Times New Roman', Times, serif;margin-left:47%;margin-bottom:0%;color:rgb(244, 214, 255)\">" .
                        $_GET["msg"] . "</p><br>
                     </div>";
                } else {
                    echo "<div>
                             <p style=\"font-family:'Times New Roman', Times, serif;margin-left:37%;margin-bottom:0%;color:red\">" .
                        $_GET["msg"] . "</p><br>
                         </div>";
                }
                unset($_GET["msg"]);
            }

            ?>

            <?php if (isset($_GET["age_min"]) && isset($_GET["age_max"])): ?>


                <div class="flexH">

                    <?php if (!isset($_GET["s"]) || (isset($_GET["s"]) && $_GET["s"] == "All")) { ?>

                        <?php foreach ($Clients as $Client): ?>
                            <?php if ($Client["Age"] > $_GET["age_min"] && $Client["Age"] <= $_GET["age_max"]) {
                                $Id_client = $Client["Id_client"]; ?>
                                <div class="article">
                                    <div class="Dataline">
                                        <div class="label_div inline_blocks"><label class="color_labels" for="nom">Nom:
                                            </label></div>
                                        <p class="inline_blocks " id="nom" name="pays">
                                            <?= $Client["Nom"] ?>
                                        </p>
                                    </div>
                                    <div class="Dataline">
                                        <div class="label_div inline_blocks"><label class="color_labels" for="prénom">Prénom:
                                            </label></div>
                                        <p class="inline_blocks " id="prénom" name="prénom">
                                            <?= $Client["Prénom"] ?>
                                        </p>
                                    </div>
                                    <div class="Dataline">
                                        <div class="label_div inline_blocks"><label class="color_labels" for="pays">Pays:
                                            </label></div>
                                        <p class="inline_blocks " id="pays" name="pays">
                                            <?= $Client["Pays"] ?>
                                        </p>
                                    </div>
                                    <div class="Dataline">
                                        <div class="label_div inline_blocks"><label class="color_labels" for="age">Age: </label>
                                        </div>
                                        <p class="inline_blocks " id="age" name="age">
                                            <?= $Client["Age"] ?>
                                        </p>
                                    </div>
                                    <div class="Dataline">
                                        <div class="label_div inline_blocks"><label class="color_labels" for="sexe">Sexe: </label>
                                        </div>
                                        <p class="inline_blocks " id="sexe" name="sexe">
                                            <?= $Client["Sexe"] ?>
                                        </p>
                                    </div>
                                    <div class="Dataline">
                                        <div class="label_div">
                                            <label class="color_labels" for="adresse_envoi">Adresse
                                                postale: </label>
                                        </div>
                                        <p Style="width:100%;Text-align:center;" id="adresse_envoi" name="adresse_envoi">
                                            <?= $Client["Adresse envoi"] ?>
                                        </p>
                                    </div>
                                    <button class="button add_btn" name="avis"
                                        onclick="window.location.href='../Page_panier/Panier.php?c=<?= $Id_client ?>'">Panier</button>
                                    <?php 
                                        echo "<button class=\"button delete_btn\" onclick=\"deleteClient($Id_client)\"
                                              name=\"Supprimer\">Supprimer</button>";
                                    }
                            ?>
                            </div>


                        <?php endforeach; ?>

                    <?php } else {
                        ?>

                        <?php if (!empty($Clients)) { ?>

                            <?php foreach ($Clients as $Client) {
                                if ($Client["Age"] > $_GET["age_min"] && $Client["Age"] <= $_GET["age_max"]) {
                                    if ($Client["Sexe"] == $_GET["s"]) {
                                        $Id_client = $Client["Id_client"];
                                        ?>

                                        <div class="article">
                                            <div class="Dataline">
                                                <div class="label_div inline_blocks"><label class="color_labels" for="nom">Nom:
                                                    </label></div>
                                                <p class="inline_blocks " id="nom" name="pays">
                                                    <?= $Client["Nom"] ?>
                                                </p>
                                            </div>
                                            <div class="Dataline">
                                                <div class="label_div inline_blocks"><label class="color_labels" for="prénom">Prénom:
                                                    </label></div>
                                                <p class="inline_blocks " id="prénom" name="prénom">
                                                    <?= $Client["Prénom"] ?>
                                                </p>
                                            </div>
                                            <div class="Dataline">
                                                <div class="label_div inline_blocks"><label class="color_labels" for="pays">Pays:
                                                    </label></div>
                                                <p class="inline_blocks " id="pays" name="pays">
                                                    <?= $Client["Pays"] ?>
                                                </p>
                                            </div>
                                            <div class="Dataline">
                                                <div class="label_div inline_blocks"><label class="color_labels" for="age">Age: </label>
                                                </div>
                                                <p class="inline_blocks " id="age" name="age">
                                                    <?= $Client["Age"] ?>
                                                </p>
                                            </div>
                                            <div class="Dataline">
                                                <div class="label_div inline_blocks"><label class="color_labels" for="sexe">Sexe: </label>
                                                </div>
                                                <p class="inline_blocks " id="sexe" name="sexe">
                                                    <?= $Client["Sexe"] ?>
                                                </p>
                                            </div>
                                            <div class="Dataline">
                                                <div class="label_div">
                                                    <label class="color_labels" for="adresse_envoi">Adresse
                                                        postale: </label>
                                                </div>
                                                <p Style="width:100%;Text-align:center;" id="adresse_envoi" name="adresse_envoi">
                                                    <?= $Client["Adresse envoi"] ?>
                                                </p>
                                            </div>
                                            <!-- Admin + gestionnaire-->
                                            <button class="button add_btn" name="avis"
                                                onclick="window.location.href='../Page_panier/Panier.php?c=<?= $Id_client ?>'">Panier</button>

                                            <?php if ($_SESSION["Type"] == "Administrateur") {
                                                echo "<button class=\"button delete_btn\" onclick=\"deleteClient($Id_client)\"
                                                 name=\"Supprimer\">Supprimer</button>";
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        } ?>

                    <?php } ?>

                </div>

            <?php else: ?>

                <div class="flexH">

                    <?php if (isset($_GET["s"])): ?>
                        <?php if (!empty($Clients)): ?>
                            <?php foreach ($Clients as $Client) {
                                if ($Client["Sexe"] == $_GET["s"] || $_GET["s"] == "All") {
                                    $Id_client = $Client["Id_client"];
                                    ?>

                                    <div class="article">
                                        <div class="Dataline">
                                            <div class="label_div inline_blocks"><label class="color_labels" for="nom">Nom:
                                                </label></div>
                                            <p class="inline_blocks " id="nom" name="pays">
                                                <?= $Client["Nom"] ?>
                                            </p>
                                        </div>
                                        <div class="Dataline">
                                            <div class="label_div inline_blocks"><label class="color_labels" for="prénom">Prénom:
                                                </label></div>
                                            <p class="inline_blocks " id="prénom" name="prénom">
                                                <?= $Client["Prénom"] ?>
                                            </p>
                                        </div>
                                        <div class="Dataline">
                                            <div class="label_div inline_blocks"><label class="color_labels" for="pays">Pays:
                                                </label></div>
                                            <p class="inline_blocks " id="pays" name="pays">
                                                <?= $Client["Pays"] ?>
                                            </p>
                                        </div>
                                        <div class="Dataline">
                                            <div class="label_div inline_blocks"><label class="color_labels" for="age">Age: </label>
                                            </div>
                                            <p class="inline_blocks " id="age" name="age">
                                                <?= $Client["Age"] ?>
                                            </p>
                                        </div>
                                        <div class="Dataline">
                                            <div class="label_div inline_blocks"><label class="color_labels" for="sexe">Sexe: </label>
                                            </div>
                                            <p class="inline_blocks " id="sexe" name="sexe">
                                                <?= $Client["Sexe"] ?>
                                            </p>
                                        </div>
                                        <div class="Dataline">
                                            <div class="label_div">
                                                <label class="color_labels" for="adresse_envoi">Adresse
                                                    postale: </label>
                                            </div>
                                            <p Style="width:100%;Text-align:center;" id="adresse_envoi" name="adresse_envoi">
                                                <?= $Client["Adresse envoi"] ?>
                                            </p>
                                        </div>
                                        <!-- Admin + gestionnaire-->
                                        <button class="button add_btn" name="avis"
                                            onclick="window.location.href='../Page_panier/Panier.php?c=<?= $Id_client ?>'">Panier</button>

                                        <?php if ($_SESSION["Type"] == "Administrateur") {
                                            echo "<button class=\"button delete_btn\" onclick=\"deleteClient($Id_client)\"
                                                  name=\"Supprimer\">Supprimer</button>";
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        <?php endif; ?>
                        <?php unset($_GET["s"]); ?>


                    <?php else: ?>


                        <?php if (!empty($Clients)): ?>
                            <?php foreach ($Clients as $Client): ?>

                                <?php $Id_client = $Client["Id_client"]; ?>

                                <div class="article">
                                    <div class="Dataline">
                                        <div class="label_div inline_blocks"><label class="color_labels" for="nom">Nom:
                                            </label></div>
                                        <p class="inline_blocks " id="nom" name="pays">
                                            <?= $Client["Nom"] ?>
                                        </p>
                                    </div>
                                    <div class="Dataline">
                                        <div class="label_div inline_blocks"><label class="color_labels" for="prénom">Prénom:
                                            </label></div>
                                        <p class="inline_blocks " id="prénom" name="prénom">
                                            <?= $Client["Prénom"] ?>
                                        </p>
                                    </div>
                                    <div class="Dataline">
                                        <div class="label_div inline_blocks"><label class="color_labels" for="pays">Pays:
                                            </label></div>
                                        <p class="inline_blocks " id="pays" name="pays">
                                            <?= $Client["Pays"] ?>
                                        </p>
                                    </div>
                                    <div class="Dataline">
                                        <div class="label_div inline_blocks"><label class="color_labels" for="age">Age: </label>
                                        </div>
                                        <p class="inline_blocks " id="age" name="age">
                                            <?= $Client["Age"] ?>
                                        </p>
                                    </div>
                                    <div class="Dataline">
                                        <div class="label_div inline_blocks"><label class="color_labels" for="sexe">Sexe: </label>
                                        </div>
                                        <p class="inline_blocks " id="sexe" name="sexe">
                                            <?= $Client["Sexe"] ?>
                                        </p>
                                    </div>
                                    <div class="Dataline">
                                        <div class="label_div">
                                            <label class="color_labels" for="adresse_envoi">Adresse
                                                postale: </label>
                                        </div>
                                        <p Style="width:100%;Text-align:center;" id="adresse_envoi" name="adresse_envoi">
                                            <?= $Client["Adresse envoi"] ?>
                                        </p>
                                    </div>
                                    <!-- Admin + gestionnaire-->
                                    <button class="button add_btn" name="avis"
                                        onclick="window.location.href='../Page_panier/Panier.php?c=<?= $Id_client ?>'">Panier</button>

                                    <?php if ($_SESSION["Type"] == "Administrateur") {
                                        echo "<button class=\"button delete_btn\" onclick=\"deleteClient($Id_client)\"
                                              name=\"Supprimer\">Supprimer</button>";
                                    } ?>
                                </div>


                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>



            <?php endif; ?>

        </section>
    </main>
    <footer>
        <p>Copyright 2022 - Site à propriété personnelle, tous droits résérvés</p>
    </footer>
</body>

</html>