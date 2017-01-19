<?php
/** CONTROLLERS LISTE PRODUIT **/

//Le modele
include("model/liste_produit.php");

//On recupere l'ID de la commande
$IdCommande = (isset($_GET['idcommade']) && $_GET['idcommade'] > 0) ? $_GET['idcommade'] : 0;

//On recupere les informations de la commade
$orders = array();
if($IdCommande > 0){
	$orders = orders($IdCommande);

	//On recupere les informations de chaque produit de la commande
	$ListeProduit = array();
	$ListeProduit = array_keys($orders['cart']);

	//On verifie si quelques produits ont passées le picking
	if(isset($_SESSION['ListeProduitFinis'])){
		$result = array();
		$result = array_diff($ListeProduit, $_SESSION['ListeProduitFinis']);

		$ListeProduit = array();
		$ListeProduit = $result;
	}

	$ListeInfosProducts = array();
	$ListeInfosProducts = getProductsList($ListeProduit);

	//Trie
	if(count($ListeInfosProducts)){
		foreach ($ListeInfosProducts as $key => $row) {
			$box[$key]  = $row['box'];
		}
		array_multisort($box, SORT_ASC, $ListeInfosProducts);
	}

	//Liste produits manquantes
	$ListeProduitManquant = array();
	if(isset($_SESSION['ListeProduitManquant'][$IdCommande])){
		$ListeProduitManquant = $_SESSION['ListeProduitManquant'][$IdCommande];
	}
}

//La vue
include("view/liste_produit.php");
?>