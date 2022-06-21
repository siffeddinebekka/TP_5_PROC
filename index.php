<?php
require_once("modele.class.php");
$unModele = new Modele("localhost:8890", "bdd_proc_heritage", "root", "root");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gestion Héritage</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="bg-dark">

<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<div class="col-auto">
			<div class="card">
				<div class="card-header">
					<h1 class="text-center">
						Gestion de l'héritage par des procédures
					</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container mt-5">
	<div class="row d-flex justify-content-center">
		<div class="col-auto">
			<a href="index.php?page=1" class="btn btn-success btn-lg w-100">Ajouter Technicien</a>
		</div>
		<div class="col-auto">
			<a href="index.php?page=2" class="btn btn-success btn-lg w-100">Ajouter Client</a>
		</div>
		<div class="col-auto">
			<a href="index.php?page=3" class="btn btn-danger btn-lg w-100">Supprimer Technicien</a>
		</div>
		<div class="col-auto">
			<a href="index.php?page=4" class="btn btn-danger btn-lg w-100">Supprimer Client</a>
		</div>
	</div>
</div>

<?php

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 0;
}

switch ($page) {
	case 1 : require_once("vue_technicien.php"); break;
	case 2 : require_once("vue_client.php"); break;
	case 3 : require_once("vue_sup_tech.php"); break;
	case 4 : require_once("vue_sup_client.php"); break;
}

if (isset($_POST['ValiderTechnicien'])) {
	$tab = array(
		"nom"=>$_POST['nom'],
		"prenom"=>$_POST['prenom'],
		"email"=>$_POST['email'],
		"mdp"=>$_POST['mdp'],
		"qualification"=>$_POST['qualification']
	);
	// Appel de la procédure
	$unModele->appelProc("insertTechnicien", $tab);
}

if (isset($_POST['ValiderClient'])) {
	$tab = array(
		"nom"=>$_POST['nom'],
		"prenom"=>$_POST['prenom'],
		"email"=>$_POST['email'],
		"mdp"=>$_POST['mdp'],
		"adresse"=>$_POST['adresse']
	);
	// Appel de la procédure
	$unModele->appelProc("insertClient", $tab);
}

if (isset($_POST['SupTech'])) {
	$tab = array("idpers"=>$_POST['idpers']);
	$unModele->appelProc("deleteTechnicien", $tab);
}

if (isset($_POST['SupClient'])) {
	$tab = array("idpers"=>$_POST['idpers']);
	$unModele->appelProc("deleteClient", $tab);
}

?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>