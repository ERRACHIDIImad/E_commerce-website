
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("myForm");
    form.method="post";

    let Pseudo = document.getElementById('pseudo');
    let Password = document.getElementById('password');


    const Verify = () => {

        parent = Pseudo.parentNode;
        if (Pseudo.value.length == 0 || Password.value.length == 0) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var nom_elt = document.createElement('div');
                nom_elt.className = 'inline_blocks  min_width insterted_blocks';

                var nom_elt2 = document.createElement('p');
                nom_elt2.className = "inserted_element";
                nom_elt2.textContent = "Veulliez renseigner les deux champs";


                nom_elt.appendChild(nom_elt2);

                Pseudo.insertAdjacentElement("afterend", nom_elt);

            }
        }

        else { HTMLFormElement.prototype.submit.call(form);}
    }


    function supprimermsgsuccesinsc() {
        const d = document.getElementById("signinsucced");
        if (d) d.remove();
    }

   function supprimermsginccorrets(){
    const d = document.getElementById("donneesincorrectes");
    if (d) d.remove();
}


    const btn = document.getElementById("div_mrgn");

    btn.addEventListener("click", () => {
        supprimermsgsuccesinsc();
        supprimermsginccorrets();
        Verify();

    });

});

