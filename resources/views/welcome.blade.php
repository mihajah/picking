<html>
	<head>
		<title>Liste des commandes</title>
		<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
		
		<script src="{{asset('public/js/jquery.min.js')}}"></script>
		<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('public/js/ajax.js')}}"></script>
	</head>
	<body>
		<div class="container">
			<center><h1>Liste des commandes</h1></center>
			<table class="table table-hover">
			<thead>
			</thead>
				<tr>
				<th>Commandes</th>
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
		
	</body>
</html> 
   