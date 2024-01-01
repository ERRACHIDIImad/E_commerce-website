function downloadText() {
    var textContent = document.getElementById('desc').textContent;

    var blob = new Blob([textContent], { type: 'text/plain' });
    var url = URL.createObjectURL(blob);


    var link = document.createElement('a');
    link.href = url;
    link.download = 'Ici the article name';

    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}

function addArticleToPanel(Id_client, Id_article) {
    const v = document.getElementById("quantité");
    var qte = v.value;
    v.value = "";
    if (confirm("Voulez vous ajouter cet article dans votre panier ?")) {
        window.location.href = "../../Controller/Controller.php?clt=" + Id_client + "&art=" + Id_article + "&qte=" + qte + "&fiche=1";
    }



}





function addComment(Id_client, Id_article) {
    var comment = document.getElementById("avis");
    var value = comment.value;
    comment.value = "";
    if (confirm("Veuillez confirmer")) {
        location.href = "../../Controller/Controller.php?add=" + value + "&to=" + Id_article + "&from=" + Id_client;
    }

}














//Avis
var comment_inserted = document.querySelectorAll(".comment_inserted");
var btns = document.getElementById('btns');

comment_inserted.forEach(e => {

    e.addEventListener('focus', () => {
        const id_avis = e.parentNode.firstChild.nextSibling;
        const id_client = id_avis.nextSibling.nextSibling;
        const id_article = id_client.nextSibling.nextSibling;
        var value1 = id_avis.value;
        var value2 = id_client.value;
        var value3 = id_article.value;
        let value = e.value;
        var avis = document.getElementById('avis');
        avis.textContent = value;

        if (btns.childElementCount == 0) {
            var supprimer = document.createElement('a');
            supprimer.textContent = "Supprimer";
            supprimer.className = "button inserted_btns";
            supprimer.href = "#";

            supprimer.addEventListener("click", () => {
                if (confirm("Voulez supprimer ce commentaire ?")) {

                    location.href = "../../Controller/Controller.php?drop=" + value1 + "&c=" + value2 + "&art=" + value3;
                }
            });

            btns.insertAdjacentElement("beforeend", supprimer);

            var modifier = document.createElement('a');
            modifier.textContent = "Modifier";
            modifier.href = "#";

            modifier.addEventListener("click", () => {
                if (confirm("Voulez-vous modifier le commentaire ?")) {
                    var Newvalue = avis.value;
                    location.href = "../../Controller/Controller.php?mod=" + value1 + "&txt=" + Newvalue + "&c=" + value2 + "&art=" + value3;
                }

            });

            modifier.className = "button inserted_btns";

            btns.insertAdjacentElement("beforeend", modifier);
        }
    });
});


















