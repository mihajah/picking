<html>
	<head>
		<title>Picking</title>
		<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
		
		<script src="{{asset('public/js/jquery.min.js')}}"></script>
		<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('public/js/ajax.js')}}"></script>
		<script src="{{asset('public/js/jquery.playSound.js')}}"></script>
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
					<td>Numéro du BOX :</td><td id="boxNumberAdd"></td>
					</tr> 
					<tr> 
					<td>Nom du produit :</td><td id="productNameAdd">  </td>
					</tr>
					<tr> 
					<td>Couleur du produit :</td><td id="colorAdd">  </td>
					</tr>
					<tr> 
					<td>Quantité commandé :</td><td id="qtyNumbAdd">  </td>
					</tr>
					<tr> 
					<td>Quantité scanné :</td><td id="qtyscan">  </td> 
					</tr>
				</table>
				<br>
				<div class="alert alert-danger" id="error_msg" style="display:none">
                          <strong>Erreur!</strong> <span id="error_msg_txt"></span>.
                        </div> 
				CODE EAN
				<input type="text" class="form-control" id="input_barcode" autofocus><br> 
				<input type="hidden" value="" class="form-control" id="input_barcode_hidden"><br> 
				<input type="hidden" value="" class="form-control" id="qty"><br> 	
				<input type="hidden" value="1" class="form-control" id="qty2"><br>				
				<center><button class="btn btn-success" id="manuel">Ajout manuel</button> <button class="btn btn-danger" id="manquant">Produit manquant</button> <a href="{{ URL::previous() }}" class="btn btn-primary">Retour</a></center>
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
		var idOrderAdd="<?php echo $id ?>";   
		var sound ="{{asset('public/sound/')}}";
		var home ="{{route('home')}}";
		var recap = "{{route('recap',['id'=>$id]) }}"
	</script>
	</body> 
</html> 
   