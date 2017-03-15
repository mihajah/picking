<html>
	<head>
		<title>Details produit</title>
		<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
		
		<script src="{{asset('public/js/jquery.min.js')}}"></script>
		<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('public/js/ajax.js')}}"></script>
		<script src="{{asset('public/js/config.js')}}"></script> 
	</head>
	<!-- debut menu -->
		<div id="tcz_header_commun_menu"/>
	<!-- fin menu -->
			
	<?php include("./../header_commun/header.php") ?>
    <?php Common_Header::forApp('Picking TechTablet') ?>
	<body>
		<div class="container">
			<center><h1>Details produit</h1></center>
			<div class="row">
			<div  class="jumbotron">
				<center><img src="" id="imageProd"></center>
			
				<br>
				<table class="table table-striped">
					<tr> 
					<td>Numéro du BOX :</td><td id="boxNumber"></td>
					</tr>
					<tr> 
					<td>ID du produit :</td><td id="idProduct">  </td>
					</tr>
					<tr> 
					<td>Nom du produit :</td><td id="productName">  </td>
					</tr>
					<tr> 
					<td>Quantité disponible :</td><td id="avQuantity">  </td>
					</tr>
					<tr> 
					<td>Quantité commandé :</td><td id="qtyNumb">  </td>
					</tr>
				</table>
				<br>
				<center><a href="{{ URL::previous() }}" class="btn btn-primary">Retour</a></center>
			</div>   
			</div>
		</div>
		<div id="modal">
			<img src="{{asset('public/css/ring.gif')}}" id="loading"> 
		</div>
		<div id="loading-wrapper">
		  <div id="loading-text">Traitement</div>
		  <div id="loading-content"></div>
		</div>
		
	<script>
			var idProd="<?php echo $idProd ?>";
			var numb="<?php echo $numb ?>";
		</script>
	</body>
</html> 
   