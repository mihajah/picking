<html>
	<head>
		<title>Liste des produits de commande</title>
		<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
		
		<script src="{{asset('public/js/jquery.min.js')}}"></script>
		<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('public/js/ajax.js')}}"></script>
		<script src="{{asset('public/js/config.js')}}"></script> 
	</head>
	<body class="picking">
		<!-- debut menu -->
		<div id="tcz_header_commun_menu"/>
		<!-- fin menu -->
		<div class="container">
		<div class="row">
			<center><h1>Liste des produits de la commande</h1></center>
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
			<center><a href="{{route('picking',['id'=>$id])}}" class="btn btn-success" style="width:150px; height:50px;font-size:25px;"><b>Picking</b></a>  <a href="{{ url('/') }}" class="btn btn-primary">Retour</a></center> 
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
			var idOrder="<?php echo $id ?>";   
		</script>
	<?php include("./../header_commun/header.php") ?>
    <?php Common_Header::forApp('Picking TechTablet') ?>
	</body> 
</html> 
   