
document.addEventListener("DOMContentLoaded", () => {


    const form = document.getElementById('myForm');


    let Sexe = document.getElementsByName('sexe');
    let Nom = document.getElementById('nom');
    let Prenom = document.getElementById('prénom');
    let Age = document.getElementById('age');
    let Pseudo = document.getElementById('pseudo');
    let Password = document.getElementById('password');
    let Password2 = document.getElementById('password2');
    let Adresse = document.getElementById('adresse');
    let Pays = document.getElementById('Pays');
    let Adress = document.getElementById('Adress');




    var Count_no_valid_elements = 0;


    const Verify = () => {

        var parent = Nom.parentNode;
        if (Nom.value.length < 2) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var nom_elt = document.createElement('div');
                nom_elt.className = 'inline_blocks  min_width insterted_blocks';

                var nom_elt2 = document.createElement('p');
                nom_elt2.className = "inserted_element";
                nom_elt2.textContent = "Un nom ne peut pas faire moins de 2 caractères";


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

        var parent = Prenom.parentNode;
        if (Prenom.value.length < 2) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var prenom_elt = document.createElement('div');
                prenom_elt.className = 'inline_blocks  min_width insterted_blocks';

                var prenom_elt2 = document.createElement('p');
                prenom_elt2.className = "inserted_element";
                prenom_elt2.textContent = "Un prénom ne peut pas faire moins de 2 caractères";

                prenom_elt.appendChild(prenom_elt2);


                Count_no_valid_elements--;
                Prenom.insertAdjacentElement("afterend", prenom_elt);

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


        var parent = Pseudo.parentNode;

        if (Pseudo.value.length < 4) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var pseudo_elt = document.createElement('div');
                pseudo_elt.className = 'inline_blocks  min_width insterted_blocks';

                var pseudo_elt2 = document.createElement('p');
                pseudo_elt2.className = "inserted_element";
                pseudo_elt2.textContent = "Le pseudo ne peut pas faire moins de 4 caractères";

                pseudo_elt.appendChild(pseudo_elt2);

                Count_no_valid_elements--;
                Pseudo.insertAdjacentElement("afterend", pseudo_elt);
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



        var parent = Password.parentNode;
        if (Password.value.length < 6) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var password_elt = document.createElement('div');
                password_elt.className = 'inline_blocks min_width insterted_blocks';

                var password_elt2 = document.createElement('p');
                password_elt2.className = "inserted_element";
                password_elt2.textContent = "Le mot de passe ne doit pas faire moins de 6 caractères";

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

        var parent = Age.parentNode;
        if (isNaN(Age.value) || Age.value > 140 || Age.value < 5) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var Age_elt = document.createElement('div');
                Age_elt.className = 'inline_blocks min_width insterted_blocks';

                var Age_elt2 = document.createElement('p');
                Age_elt2.className = "inserted_element";
                Age_elt2.textContent = "L'age doit étre compris entre 5 et 140";

                Age_elt.appendChild(Age_elt2);

                Count_no_valid_elements--;
                parent.insertAdjacentElement("beforeend", Age_elt);
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

        var parent = Password2.parentNode;

        if (Password.value != Password2.value) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var password2_elt = document.createElement('div');
                password2_elt.className = 'inline_blocks min_width insterted_blocks';

                var password2_elt2 = document.createElement('p');
                password2_elt2.className = "inserted_element";
                password2_elt2.textContent = "Les mots de passe doivent étre identiques";

                password2_elt.appendChild(password2_elt2);

                Count_no_valid_elements--;
                parent.insertAdjacentElement("beforeend", password2_elt);
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



        var parent = Pays.parentNode;
        if (Pays.selectedIndex == 0) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var Pays_elt = document.createElement('div');
                Pays_elt.className = 'inline_blocks min_width insterted_blocks';

                var Pays_elt2 = document.createElement('p');
                Pays_elt2.className = "inserted_element";
                Pays_elt2.textContent = "Vous devez sélectionner votre pays de résidence";

                Pays_elt.appendChild(Pays_elt2);

                Count_no_valid_elements--;
                parent.insertAdjacentElement("beforeend", Pays_elt);

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


        var checked = false;
        Sexe.forEach((element) => {
            if (element.checked) {
                checked = true;
            }
        });

        var parent = Sexe[0].parentNode;
        if (checked == false) {
            if (parent.childElementCount == 2) {
                parent.style.width = "62.5%";
                var sexe_elt = document.createElement('div');
                sexe_elt.className = 'inline_blocks min_width insterted_blocks';

                var sexe_elt2 = document.createElement('p');
                sexe_elt2.className = "inserted_element";
                sexe_elt2.textContent = "Vous devez sélectionner votre sexe";

                sexe_elt.appendChild(sexe_elt2);

                Count_no_valid_elements--;
                parent.insertAdjacentElement("beforeend", sexe_elt);

            }
        }
        else {
            try {
                if (parent.childElementCount == 3) {
                    Count_no_valid_elements++;
                    parent.removeChild(parent.lastChild);
                }
            } catch (e) { }
        }


        var parent = Adresse.parentNode;
        if (Adresse.value.length == 0) {
            if (parent.childElementCount == 1) {
                parent.style.width = "62.5%";
                var adresse_elt = document.createElement('div');
                adresse_elt.className = 'inline_blocks min_width insterted_blocks';

                var adresse_elt2 = document.createElement('p');
                adresse_elt2.className = "inserted_element";
                adresse_elt2.textContent = "Vous devez saisir votre adresse";

                adresse_elt.appendChild(adresse_elt2);

                Count_no_valid_elements--;
                parent.insertAdjacentElement("beforeend", adresse_elt);

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
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        async function await() {
            await sleep(3000);
            HTMLFormElement.prototype.submit.call(form);
        }

        if (Count_no_valid_elements == 0) {
            var Cong = document.createElement('p');
            Cong.className = "Congratulation_mssg inline_blocks";
            Cong.textContent = "Veullier patienter un moment ";
            Nom.insertAdjacentElement("afterend", Cong);
            await();

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

    function supprimerservererroriffound() {

        const errormsg = document.getElementById("errormsg");
       if(errormsg)errormsg.remove();
    }


    btn.addEventListener("click", () => {

        supprimerservererroriffound();
        Verify();

    });

});

