<?php
/*
 * CRON TASK
 * On recupere les données automatiquements
 **/

//Le modele
include("model/liste_commande.php");

//On recupere tous les commandes en statut 2
$getOrdersToShip = array();
$getOrdersToShip = getOrdersToShip();

if(count($getOrdersToShip) > 0){
	foreach($getOrdersToShip as $Orders){
		$id = $Orders['id'];
		$status = $Orders['status'];
		$customer = $Orders['customer'];
		$discount = $Orders['discount'];
		$cart = $Orders['cart'];
		$billing_date = $Orders['billing_date'];
		$billing_number = $Orders['billing_number'];
		$shipping_fee = $Orders['shipping_fee'];
		$delivery24 = $Orders['delivery24'];
		$payment_method = $Orders['payment_method'];
		$transaction = $Orders['transaction'];
		$transaction_date = $Orders['transaction_date'];
		$fake = $Orders['fake'];
		$createdate = $Orders['createdate'];
	}
}
?>