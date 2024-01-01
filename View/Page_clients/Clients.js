

function deleteClient(Id_client) {
  if (confirm("Veuillez confirmer la suppression de ce client ")) {
    window.location.href = "../../Controller/Controller.php?delclt=" + Id_client;
  }
};

function UpdateSearch() {

  var sexe = document.getElementById("sexeselect");
  var age = document.getElementById("ageselect");

  age_value = age.value.split('/');
  if (age_value[0] != "#") {
    if (sexe.value != "#")
      window.location.href = "./Clients.php?s=" + sexe.value + "&age_min=" + age_value[0] + "&age_max=" + age_value[1];
    else
      window.location.href = "./Clients.php?age_min=" + age_value[0] + "&age_max=" + age_value[1];
  }
  else {
    if (sexe.value != "#")
      window.location.href = "./Clients.php?s=" + sexe.value;
    else
      window.location.href = "./Clients.php?";
  }
}

