<?php
/** CONTROLLERS LISTE COMMANDE **/

//On supprimer tous les sessions qui trainnent
session_destroy();

//Le modele
include("model/liste_commande.php");

//Lit d'abord les commandes traités
$FileCommande = file_get_contents('datas/commandes.txt');
$ListeCommandeTraiter = array();
if(!empty($FileCommande)){
	$ListeCommandeTraiter = explode(',', $FileCommande);
}

//Commande fait
$IdCommande = (isset($_GET['idcommande']) && $_GET['idcommande'] > 0) ? $_GET['idcommande'] : 0;
if($IdCommande > 0){
	//AJouter à la liste des commandes traités
	if(!in_array($IdCommande, $ListeCommandeTraiter)){
		array_push($ListeCommandeTraiter, $IdCommande);
	}

	//On enregistre la liste
	$ImplodeListeCommandeTraiter = implode(',', $ListeCommandeTraiter);
	file_put_contents('datas/commandes.txt', $ImplodeListeCommandeTraiter);
}

//Traitements
$OrdersToShip = array();
$OrdersToShip = getOrdersToShip();

//La vue
include("view/liste_commande.php");
?>