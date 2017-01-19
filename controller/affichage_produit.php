<?php
/** CONTROLLERS AFFICHAGE PRODUIT **/

//Le modele
include("model/liste_produit.php");

//Traitements
$IdProducts = (isset($_GET['id']) && $_GET['id'] > 0) ? $_GET['id'] : 0;
$IdCommandes = (isset($_GET['idcommande']) && $_GET['idcommande'] > 0) ? $_GET['idcommande'] : 0;

$InfosProducts = array();
$InfoCommande = array();
if($IdProducts > 0){
	$InfosProducts = products($IdProducts);
	$InfoCommande = orders($IdCommandes);
}

//La vue
include("view/affichage_produit.php");
?>