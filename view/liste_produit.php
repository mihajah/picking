<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Liste des produits</title>

    <script type="text/javascript" src = "js/jquery-3.js"></script>
    <script type="text/javascript" src = "js/bootstrap.js"></script>
    <script type="text/javascript" src = "js/liste_produit.js"></script>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/liste_produit.css" rel="stylesheet">
 
  </head>
 
  <body>
      <div class="container conteneur_liste_produit"> 
        <div class="row"> 
          <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-hover table-bordered">
            <CAPTION ALIGN=top>LISTE DES PRODUITS</CAPTION>
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Numero Box.</th>
                  <th>Nom du produit</th>
                  <th>Quantité à prendre</th>
                  <th>Quantité en stock</th>
                  <th>Collection produit</th>
                  <th>Couleur produit</th>
                  <th>Id du produit</th>
                </tr>
              </thead>

              <tbody>
<?php
                $cpt = 1;
                foreach($ListeInfosProducts as $InfosProducts){
?>
                  <tr id = "Produit_<?php echo $InfosProducts['id']; ?>_<?php echo $orders['id']; ?>" class = "Ligne">
                    <th scope="row"><?php echo $cpt; ?></th>
                    <td><?php echo $InfosProducts['box']; ?></td>
                    <td><?php echo $InfosProducts['name']; ?></td>
                    <td><?php echo $orders['cart'][$InfosProducts['id']]; ?></td>
                    <td><?php echo $InfosProducts['quantity']; ?></td>
                    <td><?php echo $InfosProducts['collection']['name']; ?></td>
                    <td><?php echo $InfosProducts['color']['alt_name']; ?></td>
                    <td><?php echo $InfosProducts['id']; ?></td>
                  </tr>
<?php 
                  $cpt++;
                }
?>
              </tbody>
            </table>
          </div>
         </div>




         <div class = "row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-hover table-bordered">
            <CAPTION ALIGN=top>LISTE DES PRODUITS MANQUANTS</CAPTION>
              <thead> 
                <tr>
                  <th>N°</th>
                  <th>Numero Box.</th>
                  <th>Nom du produit</th>
                  <th>Quantité à prendre</th>
                  <th>Quantité en stock</th>
                  <th>Collection produit</th>
                  <th>Couleur produit</th>
                  <th>Id du produit</th>
                </tr>
              </thead>

              <tbody>
<?php
                $cptM = 1;
                foreach($ListeProduitManquant as $InfosProductsManquant){
?>
                  <tr id = "Produit_<?php echo $InfosProducts['id']; ?>_<?php echo $orders['id']; ?>" class = "Ligne">
                    <th scope="row"><?php echo $cptM; ?></th>
                    <td><?php echo $InfosProductsManquant['box']; ?></td>
                    <td><?php echo $InfosProductsManquant['name']; ?></td>
<?php
                    if(isset($_SESSION['NombrePickingProduit'][$InfosProductsManquant['id']])){
?>
                      <td><?php echo $_SESSION['NombrePickingProduit'][$InfosProductsManquant['id']]; ?></td>
<?php
                    }else{
?>
                      <td><?php echo $orders['cart'][$InfosProductsManquant['id']]; ?></td>
<?php 
                    }
?>

                    <td><?php echo $InfosProductsManquant['quantity']; ?></td>
                    <td><?php echo $InfosProductsManquant['collection']['name']; ?></td>
                    <td><?php echo $InfosProductsManquant['color']['alt_name']; ?></td>
                    <td><?php echo $InfosProductsManquant['id']; ?></td>
                  </tr>
<?php 
                  $cptM++;
                }
?>
              </tbody>
            </table>
          </div>
         </div>

         <div class = "row">
            <div class="col-md-4 col-sm-4 col-xs-12">
<?php 
              if(count($ListeInfosProducts) > 0){
?>
                <button id = "commande_<?php echo $IdCommande; ?>" class="btn btn-primary picking">Picking</button>
<?php 
              }
?>
            </div>

            <div class="col-md-8 col-sm-8 col-xs-12 retour_liste_commande">
<?php
              if(count($ListeInfosProducts) > 0){
?>
              <button class="btn btn-success retour_liste_commande">Retour sur la liste des commandes</button>
<?php 
              }else{
?>
              <button id = "commande_<?php echo $orders['id']; ?>" class="btn btn-success prochaine_commande">Passer à la prochaine commande</button>
<?php 
              }
?>
            </div>
         </div>

      </div>

      <div id = "conteneur_popup"></div>

      <div id = "ChargementsAjax">
        <p>
      </div>
 
  </body>
</html>