function UpdateSearch() {

    var type = document.getElementById("type_commande");

    if (type.value != "#") {
        location.href = "./Commandes.php?type=" + type.value;
    }
}



var validate_bnts = document.getElementsByName("validate");

validate_bnts.forEach(btn => {
    btn.addEventListener("click", () => {
        if (confirm("Veuillez confirmer la validation ")) {
            HTMLFormElement.prototype.submit.call(btn.parentNode);
        }
    })
    
    
});














