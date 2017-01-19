<?php
	//Le modele
	include("model/liste_produit.php");

	//Id de la commande en cours de picking
	$IdCommandes = (isset($_GET['idcommande']) && $_GET['idcommande'] > 0) ? $_GET['idcommande'] : 0;
	$IdPicking = (isset($_GET['id_picking']) && $_GET['id_picking'] > 0) ? $_GET['id_picking'] : 0;

	$Commandes = array();
	if($IdCommandes > 0){
		$Commandes = orders($IdCommandes);
	}

	//On recupere les informations de chaque produit de la commande
	$ListeProduit = array();
	$ListeProduit = array_keys($Commandes['cart']);

	$QuantiteProduit = 0;

	//Elever le produit de la liste
	if($IdPicking > 0){

		//On recupere la quantité du produit à scanner
		if(isset($_SESSION['NombrePickingProduit'][$IdPicking])){
			$QuantiteProduit = $_SESSION['NombrePickingProduit'][$IdPicking];
		}else{
			$QuantiteProduit = $Commandes['cart'][$IdPicking];
		}

		$QuantiteProduit = $QuantiteProduit - 1;
		$_SESSION['NombrePickingProduit'][$IdPicking] = $QuantiteProduit;

		
		if(count($_SESSION['ListeProduitFinis']) > 0){
			$ListeProduitFinis = $_SESSION['ListeProduitFinis'];
		}else{
			$ListeProduitFinis = array();
		}

		if($QuantiteProduit <= 0){
			$ListeProduitFinis[] = $IdPicking;
		}

		$ListeProduitNouveau = array();
		foreach($ListeProduit as $IdProducts){
			if(!in_array($IdProducts, $ListeProduitFinis)){
				$ListeProduitNouveau[] = $IdProducts;
			}else{
				continue;
			}
		}


		$ListeProduit = array();
		$ListeProduit = $ListeProduitNouveau;
	}else{
		$ListeProduitFinis = array();
	}

	$ListeInfosProducts = array();
	$ListeInfosProducts = getProductsList($ListeProduit);

	//Trie
	if(count($ListeInfosProducts) > 0){
		foreach ($ListeInfosProducts as $key => $row) {
			$box[$key]  = $row['box'];
		} 
		array_multisort($box, SORT_ASC, $ListeInfosProducts);
	}

	//On enregistre la liste des produits en session
	$_SESSION['ListeProduit'] = $ListeInfosProducts;

	//Liste des produits finis
	$_SESSION['ListeProduitFinis'] = $ListeProduitFinis;

	//On enregistre aussi les IDs des produits avec leurs quantités
	$_SESSION['cart'] = $Commandes['cart'];

	//On enregistre aussi l'ID de la commande
	$_SESSION['orders_id'] = $IdCommandes;

	//On verifie si on a des produits manquants
	$NbreProduit_manquantes = 0;
	if(isset($_SESSION['ListeProduitManquant'][$IdCommandes])){
		$NbreProduit_manquantes = count($_SESSION['ListeProduitManquant'][$IdCommandes]);
	}

	$NbreProduitsEnCours = 0;
	$NbreProduitsEnCours = count($ListeInfosProducts);
	
	echo $NbreProduitsEnCours.'_'.$NbreProduit_manquantes;
?>