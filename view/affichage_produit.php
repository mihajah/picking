<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Affichage produit</title>


    <script type="text/javascript" src = "js/jquery-3.js"></script>
    <script type="text/javascript" src = "js/bootstrap.js"></script>
    <script type="text/javascript" src = "js/affichage_produit.js"></script>


    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/affichage_produit.css" rel="stylesheet">
 
  </head>
 
  <body>
      <div class="container conteneur_affichage_produit">
        <div class="row"> 

          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class = "photo_produit">
              <img src = "<?php echo $InfosProducts['pictures'][0]; ?>" alt = "erreur de chargements" width = "100%" height = "100%">
            </div>
          </div>

          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class = "detail_produit">

              <ul class = "list-unstyled">
                <li>
                  <span class = "label">Numero du Box : </span>
                </li>

                <li>
                  <span class = "label">ID produit :</span>
                  <span><?php echo $InfosProducts['id'] ?></span>
                </li>

                <li>
                  <span class = "label">Nom du produit : </span>
                  <span><?php echo $InfosProducts['name']; ?></span>
                </li>

                <li>
                  <span class = "label">Quantité disponible : </span>
                  <span><?php echo $InfosProducts['quantity']; ?></span>
                </li>

                <li>
                  <span class = "label">Quantité du produit : </span>
                  <span><?php echo $InfoCommande['cart'][$InfosProducts['id']]; ?></span>
                </li>

              </ul>
            </div>
          </div>

        </div>

        <div class="separateur"></div>

        <div class = "row">
          <div class="col-md-12 col-sm-12 col-xs-12 retour_liste_produit">
            <button id = "commande_<?php echo $IdCommandes; ?>" class="btn btn-success retour_liste_produit">Retour à la liste des produits</button>
          </div>
       </div>

      </div>

      <div id = "conteneur_popup"></div>

      <div id = "ChargementsAjax">
        <p>Ajout manuel en cours ...</p>
      </div>
 
  </body>
</html>