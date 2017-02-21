var produitManquant =[];  
$(document).ready(function () {
	var produit=[];
				var produitFinal=[];
				var produitF=[]; 
				
				var countprod="";
				var i = 1;
				var qtyTemp = 0;
	
	console.log('initialiser');  
	$('#modal').hide();
	$('#loading-wrapper').show();
	
	//AFFICHAGE DE LA LISTE DES COMMANDES
	$.ajax({
            url: BASE_URL+"/getOrdersToShip",
            type: "GET",
            crossDomain: true,
            dataType: 'json',
            success: function (response) {
                var link="listeproduit/";
				var list="";
				
				$.each(response, function (index, item) {
					$('#loading-wrapper').show();
					list=list+'<tr><td><a href="'+link+item.id+'" style="display:block; width:100%;">'+item.customer.name+'</a></td></tr>';
					$("#listCommand").html(list);
				});
				$('#loading-wrapper').hide();
				//$('#modal').hide();
				//bd.remove();
            },
            error: function (xhr, status) { 
                alert("error");   
            }
        });

		//REQUETE POUR AFFICHER LES PRODUITS DE COMMANDE
	if(typeof idOrder !=="undefined"){
		var productForCart =[];
		$('#loading-wrapper').show();
		console.log(idOrder);
		$.ajax({
            url: BASE_URL+"/orders/"+idOrder,
            type: "GET",
            crossDomain: true,
            dataType: 'json',
            success: function (response) {
                var link="listeproduit/";
				var list="";
				var produit=[];
				produit=response.cart;
				console.log(produit);
				$.each(produit,function(index,item){
					$.ajax({
						url: BASE_URL+"/products/"+index,
						type: "GET",
						crossDomain: true,
						dataType: 'json',
						success: function (response2) {
						productForCart.push(response2); 
							var link="detailproduit/";
							console.log(index);
							list = list+'<tr><td>'+response2.box+'</td><td><a href="'+link+response2.id+'/'+item+'" >'+response2.name+'</a></td><td>'+item+'</td><td>'+response2.quantity+'</td><td>'+response2.collection.name+'</td><td>'+response2.color.alt_name+'</td><td>'+response2.id+'</td></tr>';
							$("#listProd").html(list);
							console.log(produitManquant);
							 
						},
						complete : function(){
							productForCart.sort(function(a, b){
								var a1= a.box, b1= b.box;
								if(a1== b1) return 0;
								return a1> b1? 1: -1;
							});
							console.log(productForCart); 
		
						},
						error: function (xhr, status) { 
							alert("error");
						}
					});
				
					
					
				});
				//$('#modal').hide();
				
				
            },
            error: function (xhr, status) {
                alert("error");
            }
        });
		
		
	}
	
	//AFFICHAGE PRODUIT 
	if(typeof idProd !=="undefined"){
		$('#loading-wrapper').show();
		console.log(idProd);
		$.ajax({
			url: BASE_URL+"/products/"+idProd,
			type: "GET", 
			crossDomain: true,
			dataType: 'json',
			success: function (response) {
				$('#imageProd').attr('src',response.pictures[0]);
				$('#boxNumber').html(response.box);
				$('#idProduct').html(response.id);
				$('#productName').html(response.name);
				$('#avQuantity').html(response.quantity);
				$('#qtyNumb').html(numb);
			},
			error: function (xhr, status) { 
				alert("error");
			}
		});
	}
	
	//AFFICHAGE PRODUIT POUR PICKING
	var counter = 0;
	if(typeof idOrderAdd !=="undefined"){
		
		console.log('ajout prod :'+idOrderAdd);
		$.ajax({
            url: BASE_URL+"/orders/"+idOrderAdd,
            type: "GET",
            crossDomain: true,
            dataType: 'json',
            success: function (response) {
                var link="listeproduit/";
				var list="";
				produit=response.cart;
				
				$.each(produit,function(index,item){
					//produitF.push({'id':index, 'qty':item});
					$.ajax({
						url: BASE_URL+"/products/"+index,
						type: "GET",
						
						crossDomain: true,
						dataType: 'json',
						success: function (response2) {
							produitF.push({'id':index, 'qty':item,'box':response2.box});
							produitF.sort(function(a, b){
											var a1= a.box, b1= b.box;
											if(a1== b1) return 0;
											return a1> b1? 1: -1;
										});
										console.log('ato ndray');
						recursive();
						},
						error: function (xhr, status,error) { 
							alert("erreur");
						}
					})
					
				});
				
            },
            error: function (xhr, status) {
                alert("error");
            }
        }).done(function() {
						
						
						//recursive();
		});
		
		
		
	}
	
	//TEST DU INPUT BARCODE
	$('#input_barcode').keyup(function(){
		var barcodeInput=$(this).val();
		var count = barcodeInput.length;
		var barcodeInputHidden=$('#input_barcode_hidden').val();
		if(barcodeInput==""){
			$('#error_msg').hide();
		}
		if(barcodeInput.match(/^\d+$/)){
			if(count<"13"){
				$('#error_msg').show();
				$('#error_msg_txt').html('Le code EAN est composé de 13 chiffres');
			}else {
				var barcodeString = barcodeInput.toString();
				var barcodeFinal = barcodeString.substring(0,12);
				
				if(barcodeFinal == barcodeInputHidden){
					var beep = new Audio(sound+'/beep.mp3');
					beep.play();
					$(this).val("");
					var test = $('#qty').val();
					var test2 = $('#qty2').val();
					if(test==test2){
						counter++;
						$('#qty2').val(1);
						$('#qtyscan').html(1);
						recursive(); 
					}else{
						console.log('condition 2');
						var res = parseInt(test2);
						res = res+1;
						$('#qty2').val(res);
						$('#qtyscan').html(res);
						recursive(); 
					}					
					$('#loading-wrapper').show();
					setTimeout(function(){ $('#loading-wrapper').hide(); }, 2000);
					console.log('compteur produit : '+countprod);
				}
				else{ 
					var beep = new Audio(sound+'/buzz.mp3');
					beep.play();
					$('#error_msg').show();
					$('#error_msg_txt').html('Code EAN erroné');
					setTimeout(function(){ $('#input_barcode').val(''); }, 2000);
				}
			}
		}else{
			$('#error_msg').show();
			$('#error_msg_txt').html('Veuillez insérer des chiffres');
		}
		
		console.log(count); 
	});
	
	
	function recursive(){
		
		console.log('lasa');
		if(counter<produitF.length){
			$('#qty').val(produitF[counter].qty);
				$.ajax({
					url: BASE_URL+"/products/"+produitF[counter].id,
					type: "GET",
					crossDomain: true,
					dataType: 'json',
					success: function (response2) {
						//console.log(index);
						$('#error_msg').hide();
						$('#imageProdAdd').attr('src',response2.pictures[0]);
						$('#boxNumberAdd').html(response2.box); 
						  
						$('#productNameAdd').html(response2.name);
						
						$('#qtyNumbAdd').html(produitF[counter].qty);
						$('#input_barcode_hidden').val(response2.ean);
						$('#colorAdd').html(response2.color.alt_name);
						//console.log('test'+countprod);
						//console.log(counter);
						//counter++;
						$('#input_barcode').val("");
						$('#input_barcode').focus();
						//i++;
						//console.log('condition 1',i);
						
						
						
					},
					error: function (xhr, status) { 
						alert("error");
					}
				});
			
			
		}else{
			var JSONmanquant= JSON.stringify(produitManquant);
			sessionStorage.setItem('pManquant',JSONmanquant); 
			window.location = recap;
		}
	}
	
	$('#manuel').click(function(){
		var test = $('#qty').val();
		var test2 = $('#qty2').val();
		if(test==test2){
			counter++;
			$('#qty2').val(1);
			$('#qtyscan').html(1);
			recursive(); 
		}else{
			console.log('condition 2');
			var res = parseInt(test2);
			res = res+1;
			$('#qty2').val(res);
			$('#qtyscan').html(res);
			recursive(); 
		}
		$('#loading-wrapper').show();
		setTimeout(function(){ $('#loading-wrapper').hide(); }, 2000);
	});
	
	$('#manquant').click(function(){
		produitManquant.push({'id':produitF[counter].id,'qty':produitF[counter].qty});
		console.log(produitManquant);
		counter++;
		recursive();
		$('#loading-wrapper').show();
		setTimeout(function(){ $('#loading-wrapper').hide(); }, 2000);
	});
	
	//AFFICHAGE PRODUIT MANQUANT
	if(typeof idOrderFin !== "undefined"){
		var pManquantJSON = sessionStorage.getItem('pManquant'); 
		var data = JSON.parse(pManquantJSON);
		var list ="";
		console.log(data);
		console.log(produitManquant);
		
		
		$('#loading-wrapper').show();
		
		$.ajax({
            url: BASE_URL+"/orders/"+idOrderFin,
            type: "GET",
            crossDomain: true,
            dataType: 'json',
            success: function (response) {
                var link="listeproduit/";
				var list="";
				var produit=[];
				produit=response.cart;
				
				console.log(produit);
				
				$.each(produit,function(index,item){
					$.ajax({
						url: BASE_URL+"/products/"+index,
						type: "GET",
						crossDomain: true,
						dataType: 'json',
						success: function (response2) {
							var link="detailproduit/";
							console.log(index);
							list = list+'<tr><td>'+response2.box+'</td><td>'+response2.name+'</td><td>'+item+'</td><td>'+response2.quantity+'</td><td>'+response2.collection.name+'</td><td>'+response2.color.alt_name+'</td><td>'+response2.id+'</td></tr>';
							$("#listProd").html(list);
							console.log(produitManquant);
						},
						error: function (xhr, status) { 
							alert("error");
						}
					});
					
				});
				
				
            },
            error: function (xhr, status) {
                alert("error");
            }
        });
		
		
		if(data.length>0){
		$.each(data,function(index,item){
			$.ajax({
				url: BASE_URL+"/products/"+item.id,
				type: "GET",
				crossDomain: true,
				dataType: 'json',
				success: function (response2) {
					var link="detailproduit/";
					console.log(item.id);
					list = list+'<tr><td>'+response2.box+'</td><td>'+response2.name+'</td><td>'+item.qty+'</td><td>'+response2.quantity+'</td><td>'+response2.collection.name+'</td><td>'+response2.color.alt_name+'</td><td>'+response2.id+'</td></tr>';
					$("#listProd2").html(list);
					console.log(produitManquant);
				},
				error: function (xhr, status) { 
					alert("error");
				}
			});
			
		});
		}
	}
	
	$('#terminus').click(function(){
		sessionStorage.clear();
		window.location = home;
	});
	
	
});    