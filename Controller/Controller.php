<?php if (!session_id())
    session_start();




//Sign in
if (isset($_POST["password2"])) {
    require_once "../DaoAndModel/Model.php";
    if (Signin($_POST["nom"], $_POST["prénom"], $_POST["pseudo"], $_POST["password"], $_POST["age"], $_POST["sexe"], $_POST["pays"], $_POST["adresse"])) {
        header("Location:../View/Page_Login/Login.php?returnmsg=Congratulations! votre inscription a été faite avec succès.");
    } else {
        header("Location:../View/Page_Inscription/Inscription.php?message=Problème de serveur, essayer plus tard");
    }
}


//Log in
if (isset($_POST["pseudo"]) && isset($_POST["password"])) {
    require_once "../DaoAndModel/Model.php";
    if (Log_in($_POST["pseudo"], $_POST["password"])) {
        header("Location:../View/Page_Acceuil/Acceuil.php");
    } else {
        header("Location:../View/Page_Login/Login.php?message=Email ou mot de passe incorrect");
    }
}



//Log out
if (isset($_GET["var"])) {
    require_once "../DaoAndModel/Model.php";
    if (Log_out()) {
        header("Location:../View/Page_Acceuil/Acceuil.php");
    } else {
        header("Location:../View/Page_Login/Login.php");
    }
}



//Add categorie to DB
if (isset($_POST["add_categ"])) {
    require_once "../DaoAndModel/Model.php";
    if (!empty($_POST["add_categ"]))
        addCatégorie($_POST["add_categ"]);
    header("Location:../View/Page_Acceuil/Acceuil.php");
}



// Delete article from DB
if (isset($_GET["delartcl"])) {
    require_once "../DaoAndModel/Model.php";
    if (dropArticle($_GET["delartcl"])) {
        $msg = "Suppression réussie";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_Acceuil/Acceuil.php?msg=" . $msg);
}


// Delete Categorie from DB
if (isset($_GET["delcatég"])) {
    require_once "../DaoAndModel/Model.php";
    if (dropCatégorie($_GET["delcatég"])) {
        $msg = "Suppression réussie";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_Acceuil/Acceuil.php?msg=" . $msg);
}




//Search a client 
if (isset($_GET["get"])) {
    require_once "../DaoAndModel/Model.php";
    $Result = getArticle($_GET["get"]);
    $_SESSION["article"] = $Result;
    header("Location:../View/Page_Acceuil/Acceuil.php?");
}

if (isset($_GET["v"])) {
    require_once "../DaoAndModel/Model.php";
    if (validateOrder($_GET["v"])) {
        $msg = "Une commande a été validée avec succès";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_Panier/Panier.php?c=" . $_GET["v"] . "&msg=$msg");
}





//Add an article to the panel 
if (isset($_GET["clt"])) {
    require_once "../DaoAndModel/Model.php";

    if (addToPanel($_GET["clt"], $_GET["art"], $_GET["qte"])) {
        $addmsg = "Un article a bien été ajouté dans votre panier";
    } else {
        $addmsg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    if (isset($_GET["fiche"]))
        header("Location:../View/Page_article/Article.php?article=" . $_GET["art"] . "&addmsg=" . $addmsg);
    else {
        header("Location:../View/Page_acceuil/Acceuil.php?addmsg=" . $addmsg);
    }
}


if (isset($_GET["co"])) {
    require_once "../DaoAndModel/Model.php";

    if (Order($_GET["co"])) {
        $msg = "Votre Commande a été effectuée avec succès";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_panier/Panier.php?c=" . $_GET["co"] . "&msg=" . $msg);
}

if (isset($_GET["del_panel"]) && isset($_GET["from"])) {
    require_once "../DaoAndModel/Model.php";
    if (deleteFromPanel($_GET["from"], $_GET["del_panel"])) {
        $msg = "Suppresion d'un article";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_panier/Panier.php?c=" . $_GET["from"] . "&msg=" . $msg);
}
require_once "../DaoAndModel/Model.php";




//Ajout d'un article dans la DB
if (isset($_POST["prix"])) {
    require_once "../DaoAndModel/Model.php";
    if (addArticle($_POST["nom"], $_POST["prix"], $_FILES["photo"], $_POST["description"], $_POST["vendeur"], $_POST["catégorie"])) {
        $msg = "Un article a été ajouté avec succès";
    } else {
        $msg = "Un problème est survenu lors de l'opération, essayer plus tard";
    }

    header("Location:../View/Page_Ajouter_Article/Add_article.php?msg=$msg");
}



// Delete Client from DB
if (isset($_GET["delclt"])) {
    require_once "../DaoAndModel/Model.php";
    if (dropClient($_GET["delclt"])) {
        $msg = "Suppression réussie";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_clients/Clients.php?msg=" . $msg);
}



//Valider une commande
if (isset($_POST["Id"])) {
    require_once "../DaoAndModel/Model.php";
    if (validateOrder($_POST["Id"])) {
        $msg = "Une Commande a été validée avec succès";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_commandes/Commandes.php?msg=" . $msg);
}










if (isset($_GET["modf"]) && isset($_GET["of"]) && isset($_GET["N_qte"])) {
    require_once "../DaoAndModel/Model.php";
    if (changeQuantity($_GET["of"], $_GET["modf"], $_GET["N_qte"])) {
        $msg = "Modification effectuée";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_panier/Panier.php?c=" . $_GET["of"] . "&msg=" . $msg);
}



if (isset($_GET["add"]) && isset($_GET["to"]) && isset($_GET["from"])) {
    require_once "../DaoAndModel/Model.php";
    if (Comment($_GET["from"], $_GET["add"], $_GET["to"])) {
        $msg = "Merci pour votre feedback";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_article/Article.php?msg=$msg&article=" . $_GET["to"] . "&c=" . $_GET["from"]);
}


if (isset($_GET["drop"])) {
    require_once "../DaoAndModel/Model.php";
    if (dropAvis($_GET["drop"])) {
        $msg = "Commentaire supprimé avec succès";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_article/Article.php?msg=$msg&article=" . $_GET["art"] . "&c=" . $_GET["c"]);
}


if (isset($_GET["mod"])) {
    require_once "../DaoAndModel/Model.php";
    if (changeComment($_GET["mod"], $_GET["txt"])) {
        $msg = "Commentaire modifié avec succès, merci pour votre feedback";
    } else {
        $msg = "Le serveur ne réponds pas,Veuillez réessayer plud tard";
    }
    header("Location:../View/Page_article/Article.php?msg=$msg&article=" . $_GET["art"] . "&c=" . $_GET["c"]);
}





?>