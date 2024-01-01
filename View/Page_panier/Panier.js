
function paiement(){
    confirm("Vous allez vous rediriger vers la page de paiement");

};


function Validate(Id_client) {
    if (confirm("Voulez vous valider cette commande ?"))
        location.href="../../Controller/Controller.php?v="+Id_client;
    };


function Commander(Id_client){
    if (confirm("Veuillez confirmer votre commande"))
    location.href="../../Controller/Controller.php?co="+Id_client;
};


function Supprimer(Id_client,Id_article){
    if (confirm("supprimer ?"))
    location.href="../../Controller/Controller.php?del_panel="+Id_article+"&from="+Id_client;

}



function Modify(Id_client,Id_article){
    var qte = prompt("Veuillez saisir la nouvelle quantité");
    if (qte)
    location.href="../../Controller/Controller.php?modf="+Id_article+"&of="+Id_client+"&N_qte="+qte;

}













