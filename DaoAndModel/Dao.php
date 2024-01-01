<?php if (!session_id())
    session_start();


function sinscrir($Nom, $Prénom, $Email, $Password, $Age, $Sexe, $Pays, $Adresse): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("insert into utilisateurs(Nom,Prénom,Email,Password) values(
            ?,
            ?,
            ?,
            ?
            );");


        $Prepared_statement->bindValue(1, $Nom);
        $Prepared_statement->bindValue(2, $Prénom);
        $Prepared_statement->bindValue(3, $Email);
        $Prepared_statement->bindValue(4, $Password);
        $Prepared_statement->execute();

        $Prepared_statement = $PDO->prepare("insert INTO clients (Id_user, age, sexe, pays, `adresse envoi`)
        SELECT
            `Id_user`,
            ?,
            ?,
            ?,
            ?
        FROM utilisateurs
        WHERE email =? and Password =?;");

        $Prepared_statement->bindValue(1, $Age);
        $Prepared_statement->bindValue(2, $Sexe);
        $Prepared_statement->bindValue(3, $Pays);
        $Prepared_statement->bindValue(4, $Adresse);
        $Prepared_statement->bindValue(5, $Email);
        $Prepared_statement->bindValue(6, $Password);
        $result = $Prepared_statement->execute();

        return true;

    } catch (Exception $e) { {
            return false;
        }

    }
}


function Login($Email, $Password): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("Select * from utilisateurs where Email=? and Password=?;");

        $Prepared_statement->bindValue(1, $Email);
        $Prepared_statement->bindValue(2, $Password);
        $Prepared_statement->execute();
        $result = $Prepared_statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            session_init();
            $_SESSION["Type"] = "Client";
            $Prepared_statement = $PDO->prepare("Select id_client from Clients where 
            Id_user = ? ; ");
            $Prepared_statement->bindValue(1, $result[0]['Id_user']);
            $Prepared_statement->execute();
            $result4 = $Prepared_statement->fetchAll(PDO::FETCH_ASSOC);
            if ($result4)
                $_SESSION["Id_client"] = $result4[0]["id_client"];

            $_SESSION["Nom"] = $result[0]["Nom"];
            $_SESSION["Prénom"] = $result[0]["Prénom"];
            $_SESSION["Id_user"] = $result[0]["Id_user"];


            $Prepared_statement = $PDO->prepare("Select * from administrateurs where 
        Id_user = ? ; ");

            $Prepared_statement->bindValue(1, $result[0]['Id_user']);
            $Prepared_statement->execute();
            $result2 = $Prepared_statement->fetchAll(PDO::FETCH_ASSOC);
            if ($result2)
                $_SESSION["Type"] = "Administrateur";


            $Prepared_statement = $PDO->prepare("Select * from gestionnaire where 
        Id_user = ? ; ");

            $Prepared_statement->bindValue(1, $result[0]['Id_user']);
            $Prepared_statement->execute();
            $result3 = $Prepared_statement->fetchAll(PDO::FETCH_ASSOC);
            if ($result3)
                $_SESSION["Type"] = "Gestionnaire";

            return true;
        }
        return false;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}



// Un gestionnaire ou Un client consulte un panier du client :
function getPanier($idclient)
{

    try {
        $PDO = new PDO("mysql:host=localhost;port=3306;dbname=site web de vente", "root", '');
        $Prepared_statement = $PDO->prepare("select B.id_article,Nomdésignation,prix_unitaire,Quantité,photo,marque,NomCatégorie,`commande effectuée`,`commande validée`
    from 
    clients A Inner join lignecommande B 
    on A.id_client=B.id_client inner join articles C
    on B.id_article=C.id_article inner join catégories D
    on D.id_catégorie=C.id_catégorie
    where A.id_client=?;");

        $Prepared_statement->bindValue(1, $idclient);
        $Prepared_statement->execute();
        $result = $Prepared_statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    } catch (PDOException $e) {
        return null;
    }
}


function SupprimerClient($idclient): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("delete A,B,C,D
    from utilisateurs A INNER JOIN clients B
    ON A.Id_user=B.id_user LEFT JOIN avis C
    ON B.Id_client=C.Id_client Left JOIN lignecommande D
    ON B.id_client = D.Id_client
    WHERE B.id_client = ?;");

        $Prepared_statement->bindValue(1, $idclient);
        $Result = $Prepared_statement->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }

}




function addArticleToPanel($idclient, $idarticle, $quantité): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("insert into lignecommande (id_client,id_article,quantité)
    values(
    ?,
    ?,
    ?);");

        $Prepared_statement->bindValue(1, $idclient);
        $Prepared_statement->bindValue(2, $idarticle);
        $Prepared_statement->bindValue(3, $quantité);
        $Result = $Prepared_statement->execute();

        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}



//Supprimer un article d'un panier:
function deleteArticleFromPanel($idclient, $idarticle): bool
{
    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("delete from lignecommande
    where id_article=? and id_client= ?;");

        $Prepared_statement->bindValue(1, $idarticle);
        $Prepared_statement->bindValue(2, $idclient);
        $Result = $Prepared_statement->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}


//Modifier quantité d'un article:
function updateQuantityArticlePanel($idclient, $idarticle, $quantité): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("update  lignecommande 
        set quantité=?
        where id_client=? and id_article=?");

        $Prepared_statement->bindValue(1, $quantité);
        $Prepared_statement->bindValue(2, $idclient);
        $Prepared_statement->bindValue(3, $idarticle);
        $Prepared_statement->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}



//Valider commande d'un client:
function validateCommand($idclient): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("update clients 
        set `commande Validée`= true where id_client=?");

        $Prepared_statement->bindValue(1, $idclient);
        $Prepared_statement->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}


function insertCatégorie($Nomcatégorie): bool
{
    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("insert into catégories(NomCatégorie) values(
            ?
            );");

        $Prepared_statement->bindValue(1, $Nomcatégorie);
        $Prepared_statement->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

//supprimer une catégorie:(Si quelques articles on été déja commandés: La catégorie concernée ne peut étre totalement supprimée à cause de quelques articles déja commandés):

function deleteCatégorie($id_catégorie): bool
{
    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("delete a,b,c,d,e from
    catégories as A
    LEFT JOIN articles as B on A.id_catégorie = B.id_catégorie
    LEFT JOIN avis as C on B.id_article= C.id_article
    LEFT JOIN Lignecommande as D on B.id_article=D.id_article
    LEFT JOIN clients as E on D.Id_client=E.Id_client
    where A.Id_catégorie=?
    and (`Commande Validée` != true or `Commande Validée` is null );");

        $Prepared_statement->bindValue(1, $id_catégorie);
        $Prepared_statement->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }

}


function deleteArticleAdmin($id_article): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("delete a,b,c,e 
    from articles A 
    LEFT JOIN avis B on A.id_article= B.id_article
    LEFT JOIN Lignecommande C on A.id_article=C.id_article
    LEFT JOIN clients E on C.Id_client=E.Id_client
    where A.id_article=?
    and (`Commande Validée` != true or `Commande Validée` is null  );");

        $Prepared_statement->bindValue(1, $id_article);
        $Prepared_statement->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }

}




//Accéder à fiche descriptive d'un article:
function getInfos($id_article)
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("select A.* ,b.*
    from articles A 
    LEFT JOIN catégories B on A.id_catégorie = B.id_catégorie 
    where A.id_article=?;");

        $Prepared_statement->bindValue(1, $id_article);
        $Prepared_statement->execute();
        $result = $Prepared_statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) { {
            return false;
        }

    }

}


//effectuer une Commande:
function setOrder($id_client): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("update Clients
    set `commande effectuée` = true where id_client=?;");

        $Prepared_statement->bindValue(1, $id_client);
        $Prepared_statement->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}


function addArticleAdmin($NomDésignation, $Prix_unitaire, $PhotoPath, $Description, $Marque, $Nomctégorie): bool
{
    try {
        require_once "DatabaseUtil.php";
        $Photo = file_get_contents($PhotoPath['tmp_name']);
        $Prepared_statement = $PDO->prepare("select Id_catégorie from catégories where NomCatégorie=?");
        $Prepared_statement->bindValue(1, $Nomctégorie);
        $Prepared_statement->execute();
        $result = $Prepared_statement->fetchAll(PDO::FETCH_ASSOC);

        $Prepared_statement = $PDO->prepare("Insert into articles(NomDésignation, Prix_unitaire, Photo, Description, Marque, id_catégorie) values(
        ?,
        ?,
        ?,
        ?,
        ?,
        ?
        );");

        $Prepared_statement->bindValue(1, $NomDésignation);
        $Prepared_statement->bindValue(2, $Prix_unitaire);
        $Prepared_statement->bindValue(3, $Photo, PDO::PARAM_LOB);
        $Prepared_statement->bindValue(4, $Description);
        $Prepared_statement->bindValue(5, $Marque);
        $Prepared_statement->bindValue(6, $result[0]["Id_catégorie"]);

        $Prepared_statement->execute();
        $result = $Prepared_statement->fetchAll(PDO::FETCH_ASSOC);
        return true;
    } catch (PDOException $e) {
        return false;
    }

}

function getcatégories()
{
    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("select * from catégories where ? ");
        $Prepared_statement->bindValue(1, "1");
        $Prepared_statement->execute();
        $Result = $Prepared_statement->fetchAll(PDO::FETCH_ASSOC);
        if ($Result)
            return $Result;
        return false;
    } catch (PDOException $ex) {
        return false;
    }


}


function getArticles()
{

    try {
        $PDO = new PDO("mysql:host=localhost;port=3306;dbname=site web de vente", "root", '');
        $stmt = $PDO->prepare("select NomCatégorie ,  A.* from articles A
    inner join catégories B on A.id_catégorie = B.id_catégorie;");
        $stmt->execute();
        $Result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($Result)
            return $Result;
        return false;
    } catch (PDOException $ex) {
        return false;
    }
}


function getArticleByname($Name_article)
{

    try {
        $PDO = new PDO("mysql:host=localhost;port=3306;dbname=site web de vente", "root", '');
        $stmt = $PDO->prepare("select * from articles where NomDésignation =?;");
        $stmt->bindValue(1, $Name_article);
        $stmt->execute();
        $Result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($Result)
            return $Result;
        return false;
    } catch (PDOException $ex) {
        return false;
    }
}





function getClients()
{

    try {
        $PDO = new PDO("mysql:host=localhost;port=3306;dbname=site web de vente", "root", '');
        $stmt = $PDO->query("select C.* , Nom ,Prénom from 
        Clients C inner join utilisateurs U on
        C.Id_user = U.Id_user;");
        $Result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($Result)
            return $Result;
        return false;
    } catch (PDOException $ex) {
        return false;
    }
}


function getClient($Id_client)
{

    try {
        $PDO = new PDO("mysql:host=localhost;port=3306;dbname=site web de vente", "root", '');
        $stmt = $PDO->prepare("select * from utilisateurs U inner join clients C 
        On U.Id_user = C.id_user  where Id_client= ?");
        $stmt->bindValue(1, $Id_client);
        $stmt->execute();
        $Result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($Result)
            return $Result;
        return false;
    } catch (PDOException $ex) {
        return false;
    }
}




























function getComments($Id_article)
{

    try {
        $PDO = new PDO("mysql:host=localhost;port=3306;dbname=site web de vente", "root", '');
        $stmt = $PDO->prepare("select * from utilisateurs E 
        inner join clients A on E.Id_user = A.id_user
        inner join avis B ON A.id_client = B.id_client
        inner join articles C ON  C.id_article = B.id_article
        where   C.id_article = ?;");
        $stmt->bindValue(1, $Id_article);
        $stmt->execute();
        $Result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Result;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }


}



//Ajouter avis:
function addComment($id_client, $Text, $id_article): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("insert into avis(id_client,Text,id_article) values(
        ?,
        ?,
        ?
        );");

        $Prepared_statement->bindValue(1, $id_client);
        $Prepared_statement->bindValue(2, $Text);
        $Prepared_statement->bindValue(3, $id_article);
        $Prepared_statement->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}








function deleteAvis($id_avis): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("delete from avis
    where id_avis=?;");

        $Prepared_statement->bindValue(1, $id_avis);
        $Prepared_statement->execute();
        $result = $Prepared_statement->fetchAll(PDO::FETCH_ASSOC);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}

//modifier avis:
function modifyComment($id_avis , $newtext): bool
{

    try {
        require_once "DatabaseUtil.php";
        $Prepared_statement = $PDO->prepare("Update avis 
        set Text=?
        where id_avis= ? ;");

        $Prepared_statement->bindValue(1, $newtext);
        $Prepared_statement->bindValue(2, $id_avis);
        $Prepared_statement->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}













function Logout(): void
{
    session_unset();
    session_destroy();
}







function session_init()
{
    if (!session_id()) {
        session_start();
        session_regenerate_id();
    }
}

























