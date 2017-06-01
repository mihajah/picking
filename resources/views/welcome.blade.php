<html>
	<head>
		<title>Liste des commandes</title>
		<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style_header.css')}}" rel="stylesheet">
		
		<script src="{{asset('public/js/jquery.min.js')}}"></script>
		<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('public/js/ajax.js')}}"></script>
		<script src="{{asset('public/js/config.js')}}"></script> 
		<script src="{{asset('public/js/config_header.js')}}"></script> 
		<script src="{{asset('public/js/header.js')}}"></script> 
		
		<style>
		/*
			tr:nth-of-type(2n){
				background-color:#cfcece
			}
			tr:nth-of-type(2n-1){
				background-color:white
			} */
		</style>
	</head>
	<body class="picking">
		<!-- debut menu -->
		<div id="tcz_header_commun_menu"></div>
		<!-- fin menu -->
		<div class="container">
			<center><h1>Liste des commandes</h1></center>
			<center><h2  class="btn-primary"><b>Not picked</b></h2></center>
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
			</table>
			
			<center><h2 class="btn-success"><b>Picked</b></h2></center>
			<table class="table table-hover">
			<thead>
			</thead>
				<tr>
				<th>Commandes</th>
				<th>N° de commande</th>
				</tr>
			</thead>
			
			<tbody id="listCommand2">
			</tbody>
			</table>
		</div>
		<div id="modal">
			<img src="{{asset('public/css/ring.gif')}}" id="loading"> 
		</div>
		
		<div id="loading-wrapper">
		  <div id="loading-text">Traitement</div>
		  <div id="loading-content"></div>
		</div>
		
		<footer class="footer" style="display:block; bottom: 0;position: fixed;">
			<span>Build 1.1.2</span>
		</footer>
	</body>
	
</html> 
   