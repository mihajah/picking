var produitManquant =[];  

var c = sessionStorage.getItem('count'); 
var decompte = 0;
var produitF=[]; 
var produitC=[]; 
var box=[];
var prodbox=[];
var prodValid=[];



function recursive(){
		
		console.log('lasa');
		if(counter< produitF.length){
			$('#qty').val(produitF[counter].qty);
				
				$.ajax({
					url: BASE_URL+"/products/"+produitF[counter].id,
					type: "GET",
					crossDomain: true,
					dataType: 'json',
					success: function (response2) {
						var test =counter+1; 
						if(typeof produitF[test]!=="undefined"){
							console.log('ato');
							if(produitF[test].box==response2.box){
								console.log('nakato');
								var boxis = response2.box;
								$('.jumbotron').hide();
								$.each(produitF,function(index,item){
									$.ajax({
										url: BASE_URL+"/products/"+item.id,
										type: "GET",
										crossDomain: true,
										dataType: 'json',
										success: function(response3){
											var list = "";
											$('#BoxMulti').html('BOX : '+boxis);
											if(response3.box==boxis){
												$('.multiple').show();
												console.log("misy produit");
												list =list+"<tr><td>"+response3.id+"</td><td>"+response3.name+"</td><td id='qtyMulti_"+response3.id+"'>"+item.qty+"</td><td>"+response3.collection.alt_name+"</td><td>"+response3.color.alt_name+"</td><td id='scan' class='test' data-id-line='"+response3.id+"'>"+response3.ean+"</td ><td><button class='btn btn-success' id='manuelMulti' onclick='ajoutMulti("+response3.id+","+item.qty+")'>Ajout manuel</button></td><td><button class='btn btn-danger' id='manquantMulti' onclick='manquantMulti("+response3.id+","+item.qty+")'>Produit manquant</button></td></tr>"; 
												$('#listProdDuplicate').append(list);
												$('#input_barcodeMultiple').focus();
												counter++;
											}
										},error: function(xhr,status){
											
										}
										});
									console.log("tonga ato amle each"); 
								});
							}else{
								console.log('ato ndray');
								$('.multiple').hide();
								$('#error_msg').hide();
								$('.jumbotron').show();
								$('#imageProdAdd').attr('src',response2.pictures[0]);
								$('#boxNumberAdd').html(produitF[counter].box); 
								  
								$('#productNameAdd').html(response2.name);
								$('#decompte').val(produitF[counter].qty);
								$('#qtyNumbAdd').html(produitC[counter].qty+'/'+produitF[counter].qty);
								 
								
								$('#input_barcode_hidden').val(response2.ean);
								$('#colorAdd').html(response2.color.alt_name);
								//console.log('test'+countprod);
								//console.log(counter);
								//counter++;
								$('#input_barcode').val("");
								$('#input_barcode').focus();

								
								//i++;
								//console.log('condition 1',i);
							}
						}else{
							console.log('ato ndray ko');
							$('#error_msg').hide();
								$('#imageProdAdd').attr('src',response2.pictures[0]);
								$('#boxNumberAdd').html(produitF[counter].box); 
								  
								$('#productNameAdd').html(response2.name);
								$('#decompte').val(produitF[counter].qty);
								$('#qtyNumbAdd').html(produitC[counter].qty+'/'+produitF[counter].qty);
								 
								
								$('#input_barcode_hidden').val(response2.ean);
								$('#colorAdd').html(response2.color.alt_name);
								//console.log('test'+countprod);
								//console.log(counter);
								//counter++;
								$('#input_barcode').val("");
								$('#input_barcode').focus();
								$('.multiple').hide();
								$('.jumbotron').show();
								//i++;
								//console.log('condition 1',i);
						}
						
						
					},
					error: function (xhr, status) { 
						alert("error");
					}
				});
			
			
			

			
		}else{
			var JSONmanquant= JSON.stringify(produitManquant);
			var JSONfini = JSON.stringify(produitF);
			sessionStorage.setItem('pManquant',JSONmanquant); 
			sessionStorage.setItem('pFini',JSONfini);
			window.location = recap;
		}
	}


console.log('ajout prod :'+c);
if(c!==null){
	counter = c;
}else{
	counter = 0;
}	

$(document).ready(function () {
	var produit=new Array();
	var produitFinal=[];
	
	var test ={};
	
	var countprod="";
	var i = 1;
	var qtyTemp = 0;
	
	console.log('initialiser');  
	$('#modal').hide();
	
	
	//AFFICHAGE DE LA LISTE DES COMMANDES
	$.ajax({
            url: BASE_URL+"/getOrdersToShip",
            type: "GET",
            crossDomain: true,
            dataType: 'json',
            success: function (response) {
                var link="listeproduit/";
				var list="";
				response.sort(function(a,b) {
					var x = a.customer.name.toLowerCase();
					var y = b.customer.name.toLowerCase();
					return x < y ? -1 : x > y ? 1 : 0;
				});
				console.log(response.length);
				var x = response.length;
				console.log(response);
				
				$.each(response, function (index, item) {
					$('#loading-wrapper').show();
					list=list+'<tr><td style="font-size: 30px;" class="nom"  ><input type="hidden" value ="'+item.customer.name+'"><a href="'+link+item.id+'" style="display:block; width:100%;" >'+item.customer.name+'</a></td><td style="font-size: 30px;">'+item.id+'</td></tr>';
					$("#listCommand").html(list);
				});
				$('#loading-wrapper').hide();
				
				
				$('#listCommand').find('.nom').each(function() {
					console.log($(this).text());
					if($('#listCommand').find('input[value="' + $(this).text() + '"]').size() > 1) {
						$(this).css('background-color','#cfcece');
					}
				});
				
            },
            error: function (xhr, status) { 
                alert("error");   
            }
        });

		//REQUETE POUR AFFICHER LES PRODUITS DE COMMANDE
	if(typeof idOrder !=="undefined"){
		var productForCart =[];
		var produit=[];
		var prodSort = [];
		console.log(idOrder);
		$.ajax({
            url: BASE_URL+"/orders/"+idOrder,
            type: "GET",
            crossDomain: true,
            dataType: 'json',
            success: function (response) {
				$('#loading-wrapper').show();
                var link="listeproduit/";
				var list="";
				produit=response.cart;
				var x = 0;
				Object.keys(produit).sort().forEach(function(key) {
				  prodSort = produit;
				  x++;
				});
				console.log(prodSort);
				var y = 0;
				$.each(prodSort,function(index,item){
					$.ajax({
						url: BASE_URL+"/products/"+index,
						type: "GET",
						crossDomain: true,
						dataType: 'json',
						success: function (response2) { 
							if($.active>0){
								$('#loading-wrapper').show();
							}
							if(item == "0"){
								y++; 
							}else{
								response2.itemNb = item;
								productForCart.push(response2); 
								var link="detailproduit/";
								console.log(index);
								console.log(produitManquant);	
								y++;
								if(y==x){
									console.log("test");
									productForCart.sort(function(a, b){
											var a1= a.box, b1= b.box;
											return a1 - b1;
										});
									$.each(productForCart,function(index,item){
										list = list+'<tr><td>'+item.box+'</td><td><a href="'+link+item.id+'/'+item.itemNb+'" >'+item.name+'</a></td><td>'+item.itemNb+'</td><td>'+item.quantity+'</td><td>'+item.collection.name+'</td><td>'+item.color.alt_name+'</td><td>'+item.id+'</td></tr>';
										$("#listProd").html(list);
										$('#loading-wrapper').hide(); 
									});	
								}
							}	 
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
	
	if(typeof idOrderAdd !=="undefined"){
		var load = 0;
		$.ajax({
            url: BASE_URL+"/orders/"+idOrderAdd,
            type: "GET",
            crossDomain: true,
            dataType: 'json',
            success: function (response) {
                var link="listeproduit/";
				var list="";
				produit=response.cart;
				var cartCount = Object.keys(produit).length;
				console.log(cartCount);
				$.each(produit,function(index,item){
					//produitF.push({'id':index, 'qty':item});
					load++;
					// console.log(load);
					$.ajax({
						url: BASE_URL+"/products/"+index,
						type: "GET",
						
						crossDomain: true,
						dataType: 'json',
						success: function (response2) { 
							if(item == "0"){
								 
							}else{
							produitF.push({id:index, qty:item,box:response2.box,qtyF:0}); 
							produitC.push({id:index, qty:item,box:response2.box}); 
							//box.push({num:response2.box});
							}
						},
						error: function (xhr, status,error) { 
							alert("erreur dans le each");
						}
					})
					
										// console.log('ato ndray');
				});
				// console.log("arrival");
				if(load==cartCount){
					checkPendingRequest();
			
				};
            },
            error: function (xhr, status) {
                alert("error");
            }
        }).done(function() {
						
						
						//recursive();
		});
		
		
		
	}
	
	
	
	 function checkPendingRequest() {
		if ($.active > 0) {
			window.setTimeout(checkPendingRequest, 1000);
			console.log("ajax en cours");
			$('#loading-wrapper').show();
		}
		else {
			$('#loading-wrapper').hide();
			console.log(produitF.length);
			produitF.sort(function(a, b){
											var a1= a.box, b1= b.box;
											return a1 - b1;
										});
										console.log('sort finish');
			produitC.sort(function(a, b){
											var a1= a.box, b1= b.box;
											return a1 - b1;
										});
										console.log('sort finish');
			//produitC.push(produitF);
			console.log(produitF);
			recursive();
		}
	};
	
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
						sessionStorage.setItem('count',counter); 
						$('#qty2').val(1);
						$('#qtyscan').html(1);
						recursive(); 
					}else{
						console.log('condition 2');
						var res = parseInt(test2);
						res = res+1;
						produitC[counter].qty--;
						produitF[counter].qtyF++; 
						$('#qty2').val(res);
						$('#qtyscan').html(res);
						recursive(); 
					}					
					$('#loading-wrapper').show();
					setTimeout(function(){ $('#loading-wrapper').hide(); }, 200);
					console.log('compteur produit : '+countprod);
				}
				else{ 
					var beep = new Audio(sound+'/buzz.mp3');
					beep.play();
					$('#error_msg').show();
					$('#error_msg_txt').html('Code EAN erroné');
					setTimeout(function(){ $('#input_barcode').val(''); }, 200);
				}
			}
		}else{
			$('#error_msg').show();
			$('#error_msg_txt').html('Veuillez insérer des chiffres');
		}
		
		console.log(count); 
	});

	//MULTISCAN
	
	$('#input_barcodeMultiple').keyup(function(){
		console.log("keyup");
		var $item = $("tr").find('#scan');
		//console.log("items" +$item.value);  
		var countItem = $item.length;
		console.log('nombre item '+countItem);
		var countBuzz = 0;
		$.each($item, function(key, value){
			var barcodeInput=$('#input_barcodeMultiple').val();
			var count = barcodeInput.length;
			if(barcodeInput.match(/^\d+$/)){
				if(count<"13"){
					$('#error_msg2').show();
					$('#error_msg_txt2').html('Le code EAN est composé de 13 chiffres'); 
				}else {
					var barcodeInputHidden=$(value).text();
					var barcodeString = barcodeInput.toString();
					var barcodeFinal = barcodeString.substring(0,12);
					console.log(barcodeInputHidden);
					console.log('introduit :'+barcodeInput);
					if(barcodeFinal == barcodeInputHidden){
						var beep = new Audio(sound+'/beep.mp3'); 
						beep.play();
						var id = $(this).attr('data-id-line');
						var qty = $('#qtyMulti_'+id).html();
						console.log(qty);
						var qtyInt = parseInt(qty);
						if(qtyInt>1){
							qtyInt--;
							
							$('#qtyMulti_'+id).html(qtyInt);
							$('#input_barcodeMultiple').val("");
						}else{
							$(value).text("OK");
							$(value).css("background-color","green");
							$(value).css("text-align","center");
							$('#error_msg2').hide();
							$('#input_barcodeMultiple').val("");
							$('#qtyMulti_'+id).html(0); 
							countOK++;
						}
						
						
						//counter++;
						console.log(countOK); 
						if(countOK==countItem){ 
							$('#listProdDuplicate').html('');
							countOK = 0; 
							recursive();
						}
						
					}
					else{
						countBuzz++;
						if(countBuzz==countItem){
							var buzz = new Audio(sound+'/buzz.mp3');
							buzz.play();
							$('#error_msg2').show();
							$('#error_msg_txt2').html('Code EAN erroné');
							setTimeout(function(){ $('#input_barcodeMultiple').val(''); }, 200);
						}
						
						
					}
				}
				
			}
			
		})
	});
	
	
	//FONCTION RECURSIVE
	
	
	$('#manuel').click(function(){
		var test = $('#qty').val();
		var test2 = $('#qty2').val();
		console.log(test);
		if(test==test2){
			console.log(res);
			produitF[counter].qtyF++;
			counter++;
			sessionStorage.setItem('count',counter); 
			$('#qty2').val(1);
			$('#qtyscan').html(1);
			
			recursive(); 
		}else{
			console.log('condition 2');
			var res = parseInt(test2);
			res = res+1;
			produitC[counter].qty--; 
			produitF[counter].qtyF++; 
			$('#qty2').val(res);
			$('#qtyscan').html(res);
			recursive(); 
		}
		$('#loading-wrapper').show();
		setTimeout(function(){ $('#loading-wrapper').hide(); }, 200);
	});
	
	$('#manquant').click(function(){
		produitManquant.push({'id':produitF[counter].id,'qty':produitC[counter].qty});
		console.log(produitManquant);
		counter++;
		sessionStorage.setItem('count',counter); 
		$('#qty2').val(1);
		recursive();  
		$('#loading-wrapper').show();
		setTimeout(function(){ $('#loading-wrapper').hide(); }, 200);
	});  
	
	//AFFICHAGE PRODUIT MANQUANT
	if(typeof idOrderFin !== "undefined"){
		var pManquantJSON = sessionStorage.getItem('pManquant'); 
		var pFiniJSON = sessionStorage.getItem('pFini'); 
		var data = JSON.parse(pManquantJSON);
		var dataFin = JSON.parse(pFiniJSON);
		var list ="";
		var list1 = "";
		console.log(data);
		console.log(produitManquant);
		
		
		
		$('#loading-wrapper').show();
		
		/*
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
				$('#societyName').html(response.customer.name);
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
							list = list+'<tr class="success"><td>'+response2.box+'</td><td>'+response2.name+'</td><td>'+item+'</td><td>'+response2.quantity+'</td><td>'+response2.collection.name+'</td><td>'+response2.color.alt_name+'</td><td>'+response2.id+'</td></tr>';
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
		*/
		console.log(dataFin);
		$.each(dataFin,function(index2,item2){
			console.log('finale');
			$.ajax({
				url: BASE_URL+"/products/"+item2.id,
				type: "GET",
				crossDomain: true,
				dataType: 'json',
				success: function (response) {
					var link="detailproduit/";
					//console.log(item.id);
					if(item2.qtyF == "0"){
						
					}else{
						list1 = list1+'<tr><td>'+response.box+'</td><td>'+response.name+'</td><td>'+item2.qtyF+'</td><td>'+response.quantity+'</td><td>'+response.collection.name+'</td><td>'+response.color.alt_name+'</td><td>'+response.id+'</td></tr>';
					}
					$("#listProd").html(list1);
				},
				error: function (xhr, status) { 
					alert("error");
				}
			});
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
					list = list+'<tr class="danger"><td>'+response2.box+'</td><td>'+response2.name+'</td><td>'+item.qty+'</td><td>'+response2.quantity+'</td><td>'+response2.collection.name+'</td><td>'+response2.color.alt_name+'</td><td>'+response2.id+'</td></tr>';
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