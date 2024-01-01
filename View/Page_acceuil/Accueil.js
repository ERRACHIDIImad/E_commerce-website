function delete_catégorie_admin(Id_catégorie) {
  if (confirm("Voulez vous vraiment supprimer cette catégorie ?")) {
    window.location.href = "../../Controller/Controller.php?delcatég=" + Id_catégorie;
  }
};


function delete_article_admin(Id_article) {
  if (confirm("Voulez vous vraiment supprimer cet article ?")) {
    window.location.href = "../../Controller/Controller.php?delartcl=" + Id_article;
  }

}




var serachartcl = document.getElementById("chercher");

serachartcl.addEventListener("click", () => {
  const nom = document.getElementById('nomarticle');
  nom.textContent = "";
  var value = nom.value;
  if(value!="")
  window.location.href = "../../Controller/Controller.php?get=" + value;



});


function addCatég(){
  const form = document.getElementById('addcatégform');
  if (confirm("Voulez vous vraiment ajouter cette catégorie ?")) {
    HTMLFormElement.prototype.submit.call(form);
  }
 form.firstChild.nextSibling.value="";

};

let purchase_btns = document.querySelectorAll('.purchase_btns');
purchase_btns.forEach(e =>
  e.addEventListener("click", () => {
    if (confirm("Vous allez vous rediriger vers la page de paiement.")) {
    }
  }));


function addArticleToPanel(Id_client, Id_article) {
  var qte = prompt("Veuller saisir la quantité disirée");
  if (qte) {
    window.location.href = "../../Controller/Controller.php?clt=" + Id_client + "&art=" + Id_article + "&qte=" + qte;
  }


}


































