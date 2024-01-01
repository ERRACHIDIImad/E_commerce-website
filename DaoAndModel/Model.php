<?php if (!session_id())
    session_start();

///////these are business logic with DB interactions ,we can add treatements:

/** */
function Signin($Nom, $Prénom, $Email, $Password, $Age, $Gender, $Pays, $Adresse): bool
{
    require_once "Dao.php";
    return (sinscrir($Nom, $Prénom, $Email, $Password, $Age, $Gender, $Pays, $Adresse));

}
/** */
function Log_in($Email, $Password): bool
{
    require_once "Dao.php";
    return (Login($Email, $Password));
}
/** */
function Log_out()
{
    require_once "Dao.php";
    Logout();
}


/** */
function addToPanel($Client, $Article, $Quantité): bool
{
    require_once "Dao.php";
    return (addArticleToPanel($Client, $Article, $Quantité));

}


/** */
function addCatégorie($Nom): bool
{
    require_once "Dao.php";
    return (insertCatégorie($Nom));

}



/** */
function dropCatégorie($Catégorie): bool
{
    require_once "Dao.php";
    return (deleteCatégorie($Catégorie));

}


/** */
function dropArticle($Article): bool
{
    require_once "Dao.php";
    return (deleteArticleAdmin($Article));
}

/** */
function addArticle($Nom, $Prix_unitaire, $Photo_path, $Description, $Marque, $Catégorie): bool
{
    require_once "Dao.php";
    return (addArticleAdmin($Nom, $Prix_unitaire, $Photo_path, $Description, $Marque, $Catégorie));

}


/** */
function Catégories()
{
    require_once "Dao.php";
    return getcatégories();

}

/** */
function Articles()
{
    require_once "Dao.php";
    return getArticles();

}

/** */
function getArticle($Name_article)
{
    require_once "Dao.php";
    return getArticleByname($Name_article);
}



/** */
function Clients()
{
    require_once "Dao.php";
    return getClients();
}

/** */
function dropClient($Client): bool
{
    require_once "Dao.php";
    return (SupprimerClient($Client));

}

/** */
function validateOrder($Client): bool
{
    require_once "Dao.php";
    return (validateCommand($Client));

}




/** */
function Total($Id_client)
{
    require_once "Dao.php";
    $panel = getPanier($Id_client);
    $Sum = 0;
    foreach ($panel as $Lignecommande)
        $Sum += $Lignecommande["prix_unitaire"] * $Lignecommande["Quantité"];

    return $Sum;

}


/** */
function Panier($Id_client)
{
    require_once "Dao.php";
    return getPanier($Id_client);
}

/** */
function Order($Client): bool
{
    require_once "Dao.php";
    return (setOrder($Client));

}



/** */
function deleteFromPanel($Client, $Article): bool
{
    require_once "Dao.php";
    return (deleteArticleFromPanel($Client, $Article));

}

/** */
function changeQuantity($Client, $Article, $Quantity): bool
{
    require_once "Dao.php";
    return (updateQuantityArticlePanel($Client, $Article, $Quantity));
}

/** */
function ArticleData($Article)
{
    require_once "Dao.php";
    return getInfos($Article);
}


/** */
function ClientData($Id_client)
{
    require_once "Dao.php";
    return getClient($Id_client);
}


function Comments($Id_article)
{
    require_once "Dao.php";
    return getComments($Id_article);
}

function Comment($Client, $Comment, $article): bool
{
    require_once "Dao.php";
    return (addComment($Client, $Comment, $article));

}


function dropAvis($Id_avis): bool
{
    require_once "Dao.php";
    return (deleteAvis($Id_avis));
}












function changeComment($id_avis, $comment): bool
{
    require_once "Dao.php";
    return (modifyComment($id_avis,$comment));
}

















































