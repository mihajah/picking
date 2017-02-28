<html>
	<head>
		<title>Picking</title>
		<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
		
		<script src="{{asset('public/js/jquery.min.js')}}"></script>
		<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('public/js/ajax.js')}}"></script>
		<script src="{{asset('public/js/jquery.playSound.js')}}"></script>
		<script src="{{asset('public/js/config.js')}}"></script> 
	</head>
	<body>
		<div class="container">
			<center><h1>Produit à prendre dans la liste</h1></center>
			<div class="row">
			<div  class="jumbotron">
				<center><img src="" id="imageProdAdd"></center>
			
				<br>
				<table class="table table-striped">
					<tr> 
					<td><h1 style="margin-top:35px;">BOX :</h1></td><td ><h1 style="font-size:85px;"><b  id="boxNumberAdd" ></b></h1></td>
					</tr> 
					<tr> 
					<td>Nom du produit :</td><td id="productNameAdd">  </td>
					</tr>
					<tr> 
					<td>Couleur du produit :</td><td id="colorAdd">  </td>
					</tr>
					<tr> 
					<td><h2>Quantité commandé :</h2></td><td><b><h1 id="qtyNumbAdd"> </h1><b></td>
					</tr>
					
				</table>
				<br>
				<div class="alert alert-danger" id="error_msg" style="display:none">
                          <strong>Erreur!</strong> <span id="error_msg_txt"></span>.
                        </div> 
				CODE EAN
				<script>
				
				</script>
				<input type="text" class="form-control" id="input_barcode" autofocus><br> 
				<input type="hidden" value="" class="form-control" id="input_barcode_hidden"><br> 
				<input type="hidden" value="" class="form-control" id="qty"><br> 	
				<input type="hidden" value="1" class="form-control" id="qty2"><br>
				<input type="hidden" value="" class="form-control" id="decompte"><br>				
				<center><button class="btn btn-success" id="manuel">Ajout manuel</button> <button class="btn btn-danger" id="manquant">Produit manquant</button><a href="{{ route('listProd',['id'=>$id]) }}" class="btn btn-primary">Retour</a></center>
			</div>  
			
			</div>
			<div class="multiple">
			<center><h1 id="BoxMulti"></h1></center>
			<table class="table" style="display:hidden">
			<thead>
			</thead>
				<tr>
				<th>ID </th>
				<th>Nom du produit </th>
				<th>Quantité à prendre </th>
				<th>Collection produit </th>
				<th>Couleur produit </th>
				<th>Scanner </th>
				</tr>
			</thead>
			
			<tbody id="listProdDuplicate">  
			</tbody>
			</table>
			<div class="alert alert-danger" id="error_msg2" style="display:none">
                          <strong>Erreur!</strong> <span id="error_msg_txt2"></span>.
                        </div> 
			<input type="text" class="form-control" id="input_barcodeMultiple" autofocus><br> 
			<center><button class="btn btn-success" id="manuelMulti">Ajout manuel</button><button class="btn btn-danger" id="manquantMulti">Produit manquant</button><a href="{{ route('listProd',['id'=>$id]) }}" class="btn btn-primary">Retour</a></center>
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
		var idOrderAdd="<?php echo $id ?>";   
		var sound ="{{asset('public/sound/')}}";
		var home ="{{route('home')}}";
		var recap = "{{route('recap',['id'=>$id]) }}"
	</script>
	</body> 
</html> 
   