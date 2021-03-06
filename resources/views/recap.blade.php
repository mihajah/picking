<html>
	<head>
		<title>Récapitulatif de la commande</title>
		<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style_header.css')}}" rel="stylesheet">
		
		<script src="{{asset('public/js/jquery.min.js')}}"></script>
		<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('public/js/ajax.js')}}"></script>
		<script src="{{asset('public/js/config.js')}}"></script>
		<script src="{{asset('public/js/config_header.js')}}"></script> 
		<script src="{{asset('public/js/header.js')}}"></script> 

	</head>
	<body class="picking">
		<!-- debut menu -->
		<div id="tcz_header_commun_menu"/>
		<!-- fin menu -->
		<div class="container">
		<div class="row"><br>
			
			<div class="jumbotron">
			<center>
			<h1 id="societyName"></h1>
			<h1 id="numCom">Numéro de commande : {{ $id }}</h1>
			</center>
			</div>
			<center><h2>Récapitulatif de la commande</h2></center>
			<center><h3>Produit(s) manquant(s)</h3></center>
			<table class="table table-hover">
			<thead>
			</thead>
				<tr>
				<th>Numéro de box </th>
				<th>Nom du produit </th>
				<th>Quantité manquante </th>
				<th>Quantité en stock </th>
				<th>Collection produit </th>
				<th>Couleur produit </th>
				<th>Id du produit </th>
				</tr>
			</thead>
			
			<tbody id="listProd2">  
			</tbody>
			</table> 
			<center ><h3 class="success">Produit(s) validé(s)</h3></center>
			<table class="table">
			<thead>
			</thead>
				<tr>
				<th>Numéro de box </th>
				<th>Nom du produit </th>
				<th>Quantité prise </th>
				<th>Quantité en stock </th>
				<th>Collection produit </th>
				<th>Couleur produit </th>
				<th>Id du produit </th>
				</tr>
			</thead>
			
			<tbody id="listProd">  
			</tbody>
			</table>
			
			<!--<center><button class="btn btn-success" id="terminus" style="font-size: 35px;">OK</button></center>-->
			<center><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="choiceForShip">Valider</button></center>

			</div>
		</div> 
		<div id="modal">
			<img src="{{asset('public/css/ring.gif')}}" id="loading" style="position: absolute;top: 50%;left: 45%;">  
		</div>
		<div id="loading-wrapper">
		  <div id="loading-text">Traitement</div>
		  <div id="loading-content"></div>
		</div>
		
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Mode d'expédition</h4>
			  </div>
			  <div class="modal-body">
				<div id="valeur" style="display:none;">
				<center>
				<input type="text" id="poids" name="poids" placeholder="poids (kg)" class="form-control">
				<input type="text" id="largeur" name="largeur" placeholder="largeur (cm)" class="form-control">
				<input type="text" id="longueur" name="longueur" placeholder="longueur (cm)" class="form-control">
				<input type="text" id="hauteur" name="hauteur" placeholder="hauteur (cm)" class="form-control">
				</center>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"  id="terminus">Annuler</button>
			  </div>
			</div>

		  </div>
		</div>
		 
		<script>
			var idOrderFin="<?php echo $id ?>";   
			var home = "{{route('home')}}";
			function mode(id,value){
				choose(id,value);
			}
			function modeChrono(id,value){
				chooseChrono(id,value);
			}
		</script>
	</body> 
</html> 
   