<?php
/** CONTROLLERS PICKING **/

//On verifie si la liste des produits sont ok
$ListesInfosProduits = array();
$ProduitProchainementPicking = array();
$ListeProduitsCart = array();

if(isset($_SESSION['ListeProduit']) && isset($_SESSION['cart']) && isset($_SESSION['orders_id'])){
	if(count($_SESSION['ListeProduit']) > 0){
		$ListesInfosProduits = $_SESSION['ListeProduit'];
		$ListeProduitsCart = $_SESSION['cart'];
		$IdCommandes = $_SESSION['orders_id'];

		//On recupere la premiere element de la liste à chaque fois
		$ProduitProchainementPicking = $ListesInfosProduits[0];
	}
}

//Nombres des picking faites sur le produits
$NbrePickingQuantites = array();
if(isset($_SESSION['NombrePickingProduit'])){
	$NbrePickingQuantites = $_SESSION['NombrePickingProduit'];
}


//La vue
include("view/picking.php");
?>
