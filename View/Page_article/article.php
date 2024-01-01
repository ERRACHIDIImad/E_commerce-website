<?php if (!session_id())
	session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Fiche description</title>
	<link rel="stylesheet" href="style.css">
	<script src="Article.js" defer></script>
	<link href="https://fonts.googleapis.com/css?family=Charm" rel="stylesheet">
</head>

<body>
	<header>
		<img src="img/images.png" alt="Logo">
		<nav>
			<ul>
				<li><a href="../Page_acceuil/Acceuil.php">Accueil</a></li>

				<?php if (isset($_SESSION["Type"])): ?>
					<?php if (($_SESSION["Type"] == "Gestionnaire" || $_SESSION["Type"] == "Administrateur")): ?>
						<li><a href="../Page_commandes/Commandes.php">Commandes</a></li>
						<?php if ($_SESSION["Type"] == "Administrateur"): ?>
							<li><a href="../Page_clients/Clients.php">Clients</a></li>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ($_SESSION["Type"] == "Client"): ?>
						<li><a href="../Page_panier/Panier.php?c=<?= $_SESSION['Id_client'] ?> ">Votre panier</a></li>
					<?php endif; ?>

					<div style="display:inline;" class="inline_blocks">
						<li style="margin-right:2%;float:right;" class="inline_blocks "><a
								href="../../Controller/Controller.php?var=logout\">Log out</a></li>
						<span style="margin-right:1.5%;float:right;">
							<?= $_SESSION["Nom"] . " " . $_SESSION["Prénom"] ?>
						</span>
					</div>

				<?php else: ?>

					<li>
						<label for="Login_signin">Log in / Sign in</label>
						<select onchange="window.location.href=this.value" name="Login_signin" id="Login_signin">
							<option value="#">Select an option</a></option>
							<option value="../Page_Login/Login.php">Log in</a></option>
							<option value="../Page_inscription/Inscription.php">Sign in</a></option>
						</select>
					</li>


				<?php endif; ?>




			</ul>
		</nav>
	</header>


	<?php
	require_once "../../DaoAndModel/Model.php";
	$Articles = ArticleData($_GET["article"]);

	if (!empty($Articles)):
		$Article = $Articles[0];
		?>

		<main>
			<?php if (isset($_GET["msg"])): ?>
				<div>
					<h5>
						<?= $_GET["msg"] ?>
					</h5>
				</div>
			<?php endif; ?>
			<section style="margin:auto;">
				<article>
					<div>
						<div>
							<div class="img_div">
								<?php $base64Image = base64_encode($Article['Photo']); ?>
								<img src="data:image/jpeg;base64,<?= $base64Image ?>" alt="">
							</div>
							<div class="infos_article">


								<div class="article-infos-divs">
									<div class="inline-infos label">
										<label class="article-infos-label" for="nom_article">Nom d'article: </label>
									</div>
									<div class="inline-infos">
										<p id="nom_article" name="nom_article">
											<?= $Article["NomDésignation"] ?>
										</p>
									</div>
								</div>

								<div class="article-infos-divs">
									<div class="inline-infos label">
										<label class="article-infos-label" for="nom_catégorie">Catégorie:</label>
									</div>
									<div class="inline-infos">
										<p id="nom_catégorie" name="nom_catégorie">
											<?= $Article["NomCatégorie"] ?>
										</p>
									</div>
								</div>

								<div class="article-infos-divs">
									<div class="inline-infos label">
										<label class="article-infos-label" for="prix">Prix: </label>
									</div>
									<div class="inline-infos">
										<p id="Prix" name="Prix">
											<?= $Article["Prix_unitaire"] ?>Dh
										</p>
									</div>
								</div>

								<div class="article-infos-divs">
									<div class="inline-infos label">
										<label class="article-infos-label" for="vendeur">Vendeur: </label>
									</div>
									<div class="inline-infos">
										<p id="vendeur" name="vendeur">
											<?= $Article["Marque"] ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>




					</div>
					<hr>
					<div id="description">
						<h2>Description:</h2>
						<a id="dwnload" class="button" onclick="downloadText();" download='Description.txt' href="#">
							Télécharger Description </a>
						<pre id="desc"
							class="clear"><p style="white-space:pre-wrap;"><?= $Article["Description"] ?></p></pre>
					</div>
					<hr>















					<?php if (isset($_SESSION["Type"]) && $_SESSION["Type"] == "Client"): ?>

						<?php $Comments = Comments($_GET["article"]); ?>

						<div style="margin-left:5%; width:40%; display:inline-block;">
							<h2>Avis sur l'article:</h2>
						</div>
						<?php if (isset($_SESSION["Id_client"]))
							echo "<div class=\"avis btns\">
							<a id=\"addbtn\" class=\"button\" onclick=\"addComment(" . $_SESSION['Id_client'] . "," . $Article["id_article"] . ")\">Ajouter avis </a><br>
						</div>";
						?>


						<textarea name="avis" id="avis"></textarea>

						<div id="btns" class="avis btns clear">

						</div>

						<div>

							<?php if (!empty($Comments)): ?>
								<div id="comments">

									<?php foreach ($Comments as $Comment): ?>
										<div class="comments_blocks  clear ">

											<input type="hidden" name=id_avis value=<?= $Comment["id_avis"] ?>>
											<input type="hidden" name=id_client value=<?= $Comment["id_client"] ?>>
											<input type="hidden" name=id_article value=<?= $Comment["id_article"] ?>>

											<label for="nom_avis">
												<?= $Comment["Nom"] . " " . $Comment["Prénom"] ?>
											</label>

											<?php if ($Comment["id_client"] == $_SESSION['Id_client']): ?>

												<textarea class="comment_inserted" id="nom"><?= $Comment["Text"] ?></textarea>

											<?php else: ?>

												<textarea class="comment_inserted" id="nom" disabled><?= $Comment["Text"] ?></textarea>

											<?php endif; ?>

										</div>

									<?php endforeach; ?>
								</div>
							<?php endif; ?>

						<?php endif; ?>


					</div>




				</article>
			</section>

			<?php if ($_SESSION["Type"] == "Client"): ?>
				<script>				(() => { const v = document.getElementsByTagName("section")[0]; v.style.width = "65%"; v.style.float = "left"; })();

				</script>
				<aside class="sidebar">

					<?php require_once "../../DaoAndModel/Model.php";
					$Client = ClientData($_SESSION["Id_client"])[0];
					?>

					<div id="clients-infos">
						<h2 class="client_labels">Nom du client: </h2>
						<div style="margin-left:-15%;" class="infos inline-infos">
							<?= $Client["Nom"] ?>
						</div><br>
						<h2 class="client_labels">Pays: </h2>
						<div style="margin-left:-15%;" class="infos inline-infos">
							<?= $Client["Pays"] ?>
						</div><br>
						<h2 class="client_labels">Email: </h2>
						<div class="infos inline-infos">
							<?= $Client["Email"] ?>
						</div><br>
						<h2 class="client_labels">Adresse d'envoi:</h2>
						<div class="infos inline-infos">
							<?= $Client["Adresse envoi"] ?>
						</div><br>
						<h2 class="client_labels">Somme à payer :</h2>
						<div style="margin-left:-10%;" class="infos inline-infos">
							<?= Total($_SESSION["Id_client"]); ?>Dh
						</div>
						<hr style="margin-bottom: -3.5%;margin-right:13%;">



						<?php
						if (isset($_GET["addmsg"])) {
							if ($_GET["addmsg"] == "Un article a bien été ajouté dans votre panier") {
								echo "
                         <p style=\"font-family:'Times New Roman', Times, serif; margin-top:8%; margin-left:7%; margin-bottom:-5%;color:green\">" .
									$_GET["addmsg"] . "</p>";

							} else {
								echo "
							<p style=\"font-family:'Times New Roman', Times, serif; margin-top:8%; margin-left:7%; margin-bottom:-5%;color:red\">" .
									$_GET["addmsg"] . "</p>";


							}

							unset($_GET["addmsg"]);
						}
						?>
						<?php
						require_once "../../DaoAndModel/Model.php";
						$Client = ClientData($_SESSION["Id_client"])[0];
						if (!$Client["Commande effectuée"]) {
							echo "
						<h2><label for=\"quantité\">Quantité</label> :</h2>
						<input class=\"button\" type=\"text\" required id=\"quantité\" name=\"quantité\">
						 <button id=\"addbtn2\" onclick=\"addArticleToPanel(" . $_SESSION["Id_client"] . "," . $_GET["article"] . ");\" class=\"button\">Ajouter au panier</button>
						</div>";
						} ?>
				</aside> </br>
			<?php endif; ?>


			</form>
		</main>
	<?php endif; ?>

	<div class="clear"></div>

	<footer>
		<p>Copyright 2022 - Site à propriété personnelle, tous droits résérvés</p>
	</footer>

</body>



</html>