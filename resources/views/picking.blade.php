<!DOCTYPE html> 
<html>
	<head>
		<title>Picking</title>
		<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
		<link href="{{asset('public/css/style_header.css')}}" rel="stylesheet">
		
		<script src="{{asset('public/js/jquery.min.js')}}"></script>
		<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('public/js/ajax.js')}}"></script>
		<script src="{{asset('public/js/jquery.playSound.js')}}"></script>
		<script src="{{asset('public/js/config.js')}}"></script>
		<script src="{{asset('public/js/config_header.js')}}"></script> 
		<script src="{{asset('public/js/header.js')}}"></script> 

	</head>
	<body class="picking">
		<!-- debut menu -->
		<div id="tcz_header_commun_menu"/>
		<!-- fin menu -->
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
					<td>id du produit :</td><td id="productIdAdd">  </td>
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
				<center><button class="btn btn-success" id="manuel" style="font-size: 35px;">Ajout manuel</button> <button class="btn btn-danger" id="manquant" style="font-size: 35px;">Produit manquant</button><a href="{{ route('listProd',['id'=>$id]) }}" class="btn btn-primary" style="font-size: 35px;">Retour</a></center>
			</div>  
			
			</div>
			<div class="multiple">
			<center><h1 id="BoxMulti"></h1></center>
			<table class="table" style="display:hidden">
			<thead>
			</thead>
				<tr>
				<th>ID </th>
				<th></th>
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
			<center><a href="{{ route('listProd',['id'=>$id]) }}" class="btn btn-primary" style="font-size: 35px;">Retour</a></center>
			</div>
		</div> 
		<div id="modal">
			<img src="{{asset('public/css/ring.gif')}}" id="loading"> 
		</div>	
		<div id="loading-wrapper">
		  <div id="loading-text">Traitement</div>
		  <div id="loading-content"></div>
		</div>
	<script type="text/javascript">    	
		var idOrderAdd="<?php echo $id ?>";   
		var sound ="{{asset('public/sound/')}}";
		var home ="{{route('home')}}";
		var recap = "{{route('recap',['id'=>$id]) }}";
		var countOK = 0;
		var counter = 0;
		var produitManquant =[];
		var produitF=[]; 
		var produitC=[]; 
		
		function ajoutMulti(id,qty){ 
			countOK++;
			console.log(id+'qty'+qty);
			var scan = $('#qtyMulti_'+id).closest("tr").find('#scan');
			
			// $('#qtyMulti_'+id).text(0);
			var nbItem = parseInt($('#qtyMulti_'+id).text());
			if(nbItem>0){
				nbItem--;
				$('#qtyMulti_'+id).text(nbItem);
				$('#qtyMoins_'+id).text(nbItem);
				console.log(produitF);
				$.each(produitF, function(index,item){
					if(item.id==id){
						item.qtyF++;
						console.log(produitF);
					}
				});
				if(nbItem==0){
					scan.text('OK');
					scan.css("background-color","#fff000");
					scan.css("text-align","center");
				}
			}else{
				
			}
			
			var $item = $("tr").find('#scan');
			var x = 0;
			var countItem = $item.length;
			$.each($item, function(key, value){
				if($(value).text() == "OK"){
					x++;
				}
			});
			
			if(x == countItem){
				countOK = 0 ; 
				//counter++;
				$('#listProdDuplicate').html('');
				recursive();
			}
		}
		
		function manquantMulti(id,qty){
			countOK++;
			produitManquant.push({'id':id,'qty':$('#qtyMulti_'+id).text()});
			var scan = $('#qtyMulti_'+id).closest("tr").find('#scan');
			scan.text('OK');
			scan.css("background-color","red");
			scan.css("text-align","center");
			$('#qtyMulti_'+id).text(0);
			$('#qtyMoins_'+id).text(0);
			var $item = $("tr").find('#scan');
			var x = 0;
			var countItem = $item.length;
			$.each($item, function(key, value){
				if($(value).text() == "OK"){
					x++;
				}
			});
			if(x == countItem){
				countOK = 0 ;
				//counter++; 
				$('#listProdDuplicate').html('');
				recursive();
			}
		}
	</script>
	</body> 
</html> 
   