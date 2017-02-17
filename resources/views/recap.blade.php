<html>
	<head>
		<title>Récapitulatif de la commande</title>
		<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
		
		<script src="{{asset('public/js/jquery.min.js')}}"></script>
		<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('public/js/ajax.js')}}"></script>
		<script src="{{asset('public/js/config.js')}}"></script> 
	</head>
	<body>
		<div class="container">
		<div class="row">
			<center><h1>Récapitulatif de la commande</h1></center>
			<table class="table table-hover">
			<thead>
			</thead>
				<tr>
				<th>Numéro de box </th>
				<th>Nom du produit </th>
				<th>Quantité à prendre </th>
				<th>Quantité en stock </th>
				<th>Collection produit </th>
				<th>Couleur produit </th>
				<th>Id du produit </th>
				</tr>
			</thead>
			
			<tbody id="listProd">  
			</tbody>
			</table>
			<center><h1>Produit(s) manquant(s)</h1></center>
			<table class="table table-hover">
			<thead>
			</thead>
				<tr>
				<th>Numéro de box </th>
				<th>Nom du produit </th>
				<th>Quantité à prendre </th>
				<th>Quantité en stock </th>
				<th>Collection produit </th>
				<th>Couleur produit </th>
				<th>Id du produit </th>
				</tr>
			</thead>
			
			<tbody id="listProd2">  
			</tbody>
			</table>
			<center><button class="btn btn-success" id="terminus">OK</button></center> 
			</div>
		</div> 
		<div id="modal">
			<img src="{{asset('public/css/ring.gif')}}" id="loading" style="position: absolute;top: 50%;left: 45%;">  
		</div>
		<div id="loading-wrapper">
		  <div id="loading-text">Traitement</div>
		  <div id="loading-content"></div>
		</div>
		 
		<script>
			var idOrderFin="<?php echo $id ?>";   
			var home = "{{route('home')}}";
		</script>
	</body> 
</html> 
   