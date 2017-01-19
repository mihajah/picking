<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Liste des commandes</title>
 
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/liste_commande.css" rel="stylesheet">

    <script type="text/javascript" src = "js/jquery-3.js"></script>
    <script type="text/javascript" src = "js/bootstrap.js"></script>
    <script type="text/javascript" src = "js/liste_commande.js"></script>
 
  </head>
 
  <body>
      <div class="container conteneur_liste_commande">
        <div class="row">
<?php
            //Liste des commandes à traiter
            foreach($OrdersToShip as $Orders){

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

              //On enleve de la liste les commandes traités
              if(!in_array($id, $ListeCommandeTraiter)){
?>
                <div class="col-md-10 col-sm-8 col-xs-12">
                  <span class = "libelle_commande"><?php echo $id.' - '.$customer['name']; ?></span>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-12">
                  <button id = "commande_<?php echo $id; ?>" class="btn btn-primary liste_produit">Liste des produits</button>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 separateur"></div>
<?php
              }else{
                continue;
              }
            }
?>
         </div>
      </div>
 
  </body>
</html>