
document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("form");
    form.method = "post";

    let Nom = document.getElementById('nom');
    let Photo = document.getElementById('photo');
    let Prix = document.getElementById('prix');
    let Catégorie = document.getElementById('catégorie');
    let Vendeur = document.getElementById('vendeur');




    var Count_no_valid_elements = 0;


    const Verify = () => {


        var parent = Nom.parentNode;
        if (!Nom.value) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var nom_elt = document.createElement('div');
                nom_elt.className = 'inline_blocks  min_width insterted_blocks';

                var nom_elt2 = document.createElement('p');
                nom_elt2.className = "inserted_element";
                nom_elt2.textContent = "Veuillez renseigner le nom d'article";


                nom_elt.appendChild(nom_elt2);


                Count_no_valid_elements--;
                parent.insertAdjacentElement("beforeend", nom_elt);

            }
        }
        else {
            try {
                if (parent.childElementCount == 2) {
                    Count_no_valid_elements++;
                    parent.removeChild(parent.lastChild);
                }
            } catch (e) { }
        }

        var parent = Photo.parentNode;
        if (Photo.files.length == 0) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62%";
                Photo.style.marginRight = "-15%";
                var previouos = parent.previousSibling.previousSibling;
                previouos.style.marginLeft = "24.3%";
                var prenom_elt = document.createElement('div');
                prenom_elt.className = 'inline_blocks  min_width';

                var prenom_elt2 = document.createElement('p');
                prenom_elt2.className = "inserted_element";
                prenom_elt2.textContent = "Veuillez inserer une photo";

                prenom_elt.appendChild(prenom_elt2);


                Count_no_valid_elements--;
                parent.insertAdjacentElement("beforeend", prenom_elt);

            }
        }
        else {
            try {
                if (parent.childElementCount == 2) {
                    Count_no_valid_elements++;
                    parent.removeChild(parent.lastChild);
                }
            } catch (e) { }
        }


        var parent = Prix.parentNode;
        if (!Prix.value) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var pseudo_elt = document.createElement('div');
                pseudo_elt.className = 'inline_blocks  min_width insterted_blocks';

                var pseudo_elt2 = document.createElement('p');
                pseudo_elt2.className = "inserted_element";
                pseudo_elt2.textContent = "Veuillez renseigner le prix d'article";

                pseudo_elt.appendChild(pseudo_elt2);

                Count_no_valid_elements--;
                parent.insertAdjacentElement("beforeend", pseudo_elt);
            }
        }
        else {
            try {
                if (parent.childElementCount == 2) {
                    Count_no_valid_elements++;
                    parent.removeChild(parent.lastChild);
                }

            } catch (e) { }
        }



        var parent = Vendeur.parentNode;
        if (!Vendeur.value) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var password_elt = document.createElement('div');
                password_elt.className = 'inline_blocks min_width insterted_blocks';

                var password_elt2 = document.createElement('p');
                password_elt2.className = "inserted_element";
                password_elt2.textContent = "Veullier mentionner le vendeur";

                password_elt.appendChild(password_elt2);

                Count_no_valid_elements--;
                parent.insertAdjacentElement("beforeend", password_elt);


            }
        }
        else {
            try {
                if (parent.childElementCount == 2) {
                    Count_no_valid_elements++;
                    parent.removeChild(parent.lastChild);
                }
            } catch (e) { }
        }

        var parent = Catégorie.parentNode;
        if (!Catégorie.value) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var password_elt = document.createElement('div');
                password_elt.className = 'inline_blocks min_width insterted_blocks';

                var password_elt2 = document.createElement('p');
                password_elt2.className = "inserted_element";
                password_elt2.textContent = "Veullier mentionner sa catégorie";

                password_elt.appendChild(password_elt2);

                Count_no_valid_elements--;
                parent.insertAdjacentElement("beforeend", password_elt);


            }
        }
        else {
            try {
                if (parent.childElementCount == 2) {
                    Count_no_valid_elements++;
                    parent.removeChild(parent.lastChild);
                }
            } catch (e) { }
        }


        if (Count_no_valid_elements == 0) {
            HTMLFormElement.prototype.submit.call(form);
        }



    };










    const btn = document.getElementById("div_mrgn");
    const btn2 = document.querySelector("input[type='reset']");


    btn.addEventListener("mouseover", () => {

        btn.style.borderColor = "rgba(0, 255, 255,0.3)";
    });

    btn.addEventListener("mouseout", () => {

        btn.style.borderColor = 'rgb(191,191,191)';
    });

    btn2.addEventListener("mouseover", () => {

        btn2.style.borderColor = "rgba(0, 255, 255,0.3)";
    });
    btn2.addEventListener("mouseout", () => {

        btn2.style.borderColor = "rgb(191,191,191)";
    });



    function addArticleServerErrorFound() {
        const errormsg = document.getElementsByClassName("returns")[0];
        if(errormsg)errormsg.remove();

    }

    btn.addEventListener("click", () => {
        addArticleServerErrorFound();
        Verify();

    });

});

