<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Affichage produit</title>

    <script type="text/javascript" src = "js/jquery-3.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src = "js/jquery.playSound.js"></script>
    <script type="text/javascript" src = "js/bootstrap.js"></script>
    <script type="text/javascript" src = "js/picking.js"></script>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/picking.css" rel="stylesheet">

 
  </head>
 
  <body>
      <div class="container conteneur_picking">
        <div class="row">

          <div class="col-md-8 col-sm-8 col-xs-12">
            <ul class = "list-unstyled">
              <li><h1>Num.Box : <?php echo $ProduitProchainementPicking['box']; ?></h1></li>
              <li><h1>Couleur produit : <?php echo $ProduitProchainementPicking['color']['alt_name']; ?></h1></li>
              <li>
                <h4>
                  Quantité du produit : 
<?php
                    if(isset($NbrePickingQuantites[$ProduitProchainementPicking['id']])){
                       //echo $NbrePickingQuantites[$ProduitProchainementPicking['id']].'/'.$ListeProduitsCart[$ProduitProchainementPicking['id']];
                       echo (($ListeProduitsCart[$ProduitProchainementPicking['id']] - $NbrePickingQuantites[$ProduitProchainementPicking['id']])+1).'/'.$ListeProduitsCart[$ProduitProchainementPicking['id']];
                    }else{
                       echo '1/'.$ListeProduitsCart[$ProduitProchainementPicking['id']];
                    }
?>
                </h4>
              </li>
              <li><h5>Nom du produit : <?php echo $ProduitProchainementPicking['name']; ?></h5></li>
            </ul>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-12">

            <div class = "row">
              <div class="col-md-12 col-sm-12 col-xs-12 photo_produit">
                <img src = "<?php echo $ProduitProchainementPicking['pictures'][0]; ?>" alt = "erreur de chargements" width = "100%" height = "100%">
              </div>
            </div>

            <div class="separateur"></div>

            <div class = "row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-success ajout_manuel" id="produit_<?php echo $ProduitProchainementPicking['id']; ?>_<?php echo $IdCommandes; ?>" style = "width:100%;">Ajout manuel</button>
              </div>
            </div>

          </div>
        </div>

        <div class="separateur"></div>

        <div class="row"> 

            <div class="col-md-2 col-sm-2 col-xs-12">
              <span class = "label">Code barre : </span>
            </div>

            <div class="col-md-10 col-sm-10 col-xs-12">
              <input id = "id_code_barre" class = "input_code_barre" type = "text" name = "code_barre" value = "">
              <input id = "id_code_barre_hidden" class = "input_code_barre_hidden" type = "hidden" name = "code_barre_hidden" value = "<?php echo $ProduitProchainementPicking['ean']; ?>">
              <input id = "id_produit_hidden" class = "input_produit_hidden" type = "hidden" name = "produit_hidden" value = "<?php echo $ProduitProchainementPicking['id']; ?>">
              <input id = "id_commande_hidden" class = "input_commande_hidden" type = "hidden" name = "commande_hidden" value = "<?php echo $IdCommandes; ?>">
            </div>

        </div>

        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-12"></div>

            <div class="col-md-8 col-sm-8 col-xs-12">
              <button id = "produit_<?php echo $ProduitProchainementPicking['id']; ?>_<?php echo $IdCommandes; ?>" class="btn btn-primary produit_manquant">Produit manquant</button>
            </div>

            <div class="col-md-2 col-sm-2 col-xs-12 retour_liste_produit">
              <button id = "commande_<?php echo $IdCommandes; ?>" class="btn btn-success retour_liste_produit">Retour</button>
            </div>

        </div>

      </div>

      <div id = "conteneur_popup"></div>

      <div id = "ChargementsAjax">
        <p>Verification en cours ...</p>
      </div>
 
  </body>
</html>