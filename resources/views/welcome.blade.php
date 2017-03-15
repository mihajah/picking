<html>
	<head>
		<title>Liste des commandes</title>
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
			<center><h1>Liste des commandes</h1></center>
			<table class="table table-hover">
			<thead>
			</thead>
				<tr>
				<th>Commandes</th>
				<th>N° de commande</th>
				</tr>
			</thead>
			
			<tbody id="listCommand">
			</tbody>
		</div>
		<div id="modal">
			<img src="{{asset('public/css/ring.gif')}}" id="loading"> 
		</div>
		
		<div id="loading-wrapper">
		  <div id="loading-text">Traitement</div>
		  <div id="loading-content"></div>
		</div>
		
		<footer class="footer" style="display:block; bottom: 0;position: absolute;">
			<span>Build 1.1.2</span>
		</footer>
	</body>
	
</html> 
   