<?php if (!session_id())
    session_start();

if (!isset($_SESSION["Type"]) || ($_SESSION["Type"] != "Administrateur" && $_SESSION["Type"] != "Gestionnaire"))
    header("Location:../Page_acceuil/Acceuil.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Commandes.css">
    <script src="Commandes.js" defer></script>
    <title>Commandes</title>
</head>

<body>

    <header>
        <img src="img/images.png" alt="Logo">


        <nav>
            <!-- gestionnaire+gestionnaire --->
            <li><a href="../Page_acceuil/Acceuil.php">Acceuil</a></li>
            <img src="img/download.png" alt="filter">


            <select name="type_commadne" onchange="UpdateSearch();" id="type_commande">
                <option value="#">Type</option>
                <option value="All">All</option>
                <option value="Commande effectuée">Commandes effectuées</option>
                <option value="Commande Validée">Commandes validées</option>
            </select>

            <div Style="width:68%;" class="inline_blocks">
                <li style="margin-right:2%;float:right;" class="inline_blocks "><a
                        href="../../Controller/Controller.php?var=logout\">Log out</a></li>
                <span style="margin-right:2%;float:right;">
                    <?= $_SESSION["Nom"] . " " . $_SESSION["Prénom"] ?>
                </span>
            </div>
        </nav>
    </header>

    <?php
    require_once "../../DaoAndModel/Model.php";
    $Clients = Clients();


    if (isset($_GET["msg"])) {
        if ($_GET["msg"] == "Une Commande a été validée avec succès") {
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

    <main>
        <section style="overflow:scroll;height: 100em;">


            <div class="flexH">



                <?php if (isset($_GET["type"])): ?>


                <?php if (!empty($Clients)) {

                    $Type = $_GET["type"];
                    foreach ($Clients as $Client) {
                        if ($Type == "All" || $Client[$Type]) {
                            $Id_client = $Client["Id_client"];
                            require_once "../../DaoAndModel/Model.php";
                            $Total = Total($Id_client);
                            ?>

                <div class="article">
                    <div>
                        <div class="label_div inline_blocks"><label class="color_labels" for="effectuée">Commande
                                effectuée:</label></div>
                        <p class="inline_blocks " id="effectuée" name="effectuée">
                            <?php echo ($Client["Commande effectuée"]) ? "oui" : "non" ?>
                        </p>
                    </div>
                    <div>
                        <div class="label_div inline_blocks"><label class="color_labels" for="validée">Commande validée:
                            </label></div>
                        <p class="inline_blocks " id="validée" name="validée">
                            <?php echo ($Client["Commande Validée"]) ? "oui" : "non" ?>
                        </p>
                    </div>
                    <div>
                        <div class="label_div inline_blocks"><label class="color_labels" for="Total">Total à payer:
                            </label></div>
                        <p class="inline_blocks " id="Total" name="Total">
                            <?= $Total ?>
                        </p>
                    </div>

                    <?php echo "
                                <form  style=\"margin-left:55%;display:inline;width:20%;\" action=\"../../Controller/Controller.php\" method=\"post\"> 
                                <input type=\"hidden\" name=\"Id\" value=\"$Id_client\"> 
                                <input class=\"button\" type=\"button\" name=\"validate\" value=\"Valider\">
                                </form>" ?>

                    <button class="button add_btn" name="panier"
                        onclick="location.href='../Page_panier/Panier.php?c=<?= $Id_client ?>'">Panier</button>

                </div>
                <?php
                        }
                    }
                }
                unset($_GET["type"]); ?>



                <?php else: ?>





                <?php if (!empty($Clients)) {
                    foreach ($Clients as $Client) {
                        $Id_client = $Client["Id_client"];
                        require_once "../../DaoAndModel/Model.php";
                        $Total = Total($Id_client);
                        ?>
                <div class="article">
                    <div>
                        <div class="label_div inline_blocks"><label class="color_labels" for="effectuée">Commande
                                effectuée:</label></div>
                        <p class="inline_blocks " id="effectuée" name="effectuée">
                            <?php echo ($Client["Commande effectuée"]) ? "oui" : "non" ?>
                        </p>
                    </div>
                    <div>
                        <div class="label_div inline_blocks"><label class="color_labels" for="validée">Commande validée:
                            </label></div>
                        <p class="inline_blocks " id="validée" name="validée">
                            <?php echo ($Client["Commande Validée"]) ? "oui" : "non" ?>
                        </p>
                    </div>
                    <div>
                        <div class="label_div inline_blocks"><label class="color_labels" for="Total">Total à payer:
                            </label></div>
                        <p class="inline_blocks " id="Total" name="Total">
                            <?= $Total ?>
                        </p>
                    </div>

                    <?php echo "
                                        <form  style=\"margin-left:55%;display:inline;width:20%;\" action=\"../../Controller/Controller.php\" method=\"post\"> 
                                        <input type=\"hidden\" name=\"Id\" value=\"$Id_client\"> 
                                        <input class=\"button\" type=\"button\" name=\"validate\" value=\"Valider\">
                                        </form>" ?>

                    <button class="button add_btn" name="panier"
                        onclick="location.href='../Page_panier/Panier.php?c=<?= $Id_client ?>'">Panier</button>

                </div>

                <?php
                    }
                } ?>



                <?php endif; ?>



            </div>


        </section>
    </main>
    <footer>
        <p>Copyright 2022 - Site à propriété personnelle, tous droits résérvés</p>
    </footer>
</body>

</html>