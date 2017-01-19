$(document).ready(function(){
	//Actviter la mask de saisie
	$(document).on('focusin', 'input.input_code_barre', function(){
		//Forcer la saisie des 13 chiffres
		$(this).mask("9999999999999",{
			completed:function(){
				var EAN_Product = $('input#id_code_barre_hidden').val();
				var ChiffreSaisie = this.val();
				var ChiffreSaisieStr = ChiffreSaisie.toString();

				//On compare que les 12 premier digits
				var EAN_Saisie = ChiffreSaisieStr.substring(0, 12);

				//Code barre ok
				if(EAN_Product == EAN_Saisie){

					$.playSound('files/beep');

					//Id produit
					var id_picking = $('input#id_produit_hidden').val();
					var idcommande = $('input#id_commande_hidden').val();

					$('div#conteneur_popup').show();
	                $('div#ChargementsAjax').show();

					$.ajax({

			            type: "GET",
			            url : "index.php?page=mode_picking",
			            data: "idcommande="+idcommande+"&id_picking="+id_picking+"",
			            //async: false,
			            beforeSend: function() {
			                $('div#conteneur_popup').show();
			                $('div#ChargementsAjax').show();
			            },
			            success: function(response){

			            	var ArrayReponse = new Array;
			            	ArrayReponse = response.split('_');

			            	var RetourPincking = parseInt(ArrayReponse[0]);
			            	var RetourProduitManquant = parseInt(ArrayReponse[1]);

			            	if(RetourPincking > 0){
			            		$('div#ChargementsAjax p').html('Affichage prochaine produit');
			            		setTimeout(function(){
				            		window.location = 'index.php?page=picking&idcommande='+idcommande+'';
				            	}, 1000);
			            	}else if(RetourProduitManquant > 0){
			            		$('div#ChargementsAjax p').html('Picking terminer.Liste des produits manquants');
			            		setTimeout(function(){
				            		window.location = 'index.php?page=liste_produit&idcommade='+idcommande+''; 
				            	}, 1000);
			            	}else{
			            		$('div#ChargementsAjax p').html('Picking terminer.Retour à la liste des commandes');
			            		setTimeout(function(){
				            		window.location = 'index.php?idcommande='+idcommande+''; 
				            	}, 1000);
			            	}
			            },
			            error: function(){
			                $('div#conteneur_popup').show();
			                $('div#ChargementsAjax').show();
			                $('div#ChargementsAjax p').html('Erreur de chargement');
			            }
			        });
				}else{
					$.playSound('files/buzz');
					$(this).val('');
					$(this).focus();
				}
			}
		});
	});


	$(document).on('click', 'button.ajout_manuel', function(){
		var ID = $(this).attr('id');
		var ArrayID = new Array;
		ArrayID = ID.split('_');

		var idProduit = ArrayID[1];
		var idCommande = ArrayID[2];


		$.ajax({

            type: "GET",
            url : "index.php?page=mode_ajout_manuel",
            data: "idcommande="+idCommande+"&idproduit="+idProduit+"",
            //async: false,
            beforeSend: function() {
                $('div#conteneur_popup').show();
                $('div#ChargementsAjax').show();
                $('div#ChargementsAjax p').html('Ajout en cours ...');
            },
            success: function(response){

            	var ArrayReponse = new Array;
            	ArrayReponse = response.split('_');

            	var RetourPincking = parseInt(ArrayReponse[0]);
            	var RetourProduitManquant = parseInt(ArrayReponse[1]);

            	if(RetourPincking > 0){
            		$('div#ChargementsAjax p').html('Ajout terminer.Redirection vers le picking');
            		setTimeout(function(){
	            		window.location = 'index.php?page=picking&idcommande='+idCommande+'';
	            	}, 1000);
            	}else if(RetourProduitManquant > 0){
            		$('div#ChargementsAjax p').html('Ajout terminer.Retour à la liste des produits manquants');
            		setTimeout(function(){
	            		window.location = 'index.php?page=liste_produit&idcommade='+idCommande+''; 
	            	}, 1000);
            	}else{
            		$('div#ChargementsAjax p').html('Ajout terminer.Retour à la liste des commandes');
            		setTimeout(function(){
	            		window.location = 'index.php?idcommande='+idCommande+'';
	            	}, 1000);
            	}
            },
            error: function(){
                $('div#conteneur_popup').show();
                $('div#ChargementsAjax').show();
                $('div#ChargementsAjax p').html('Erreur de chargement');
            }
        });
	});

	

	//Activer toujours le focus sur le champs de saisie des codes barres
	$('input.input_code_barre').focus();
	$('input.input_code_barre').click();


	$(document).on('click', 'button.retour_liste_produit', function(){
		var ID = $(this).attr('id');
		var ArrayID = new Array;
		ArrayID = ID.split('_');
		window.location = 'index.php?page=liste_produit&idcommade='+ArrayID[1]+'';
	});

	$(document).on('click', 'button.plus_information', function(){
		var ID = $(this).attr('id');
		var ArrayID = new Array;
		ArrayID = ID.split('_');
		window.location = 'index.php?page=affichage_produit&id='+ArrayID[1]+'&idcommande='+ArrayID[2]+'';
	});

	$(document).on('click', 'button.produit_manquant', function(){
		var ID = $(this).attr('id');
		var ArrayID = new Array;
		ArrayID = ID.split('_');

		var IdProduit = ArrayID[1];
		var IdCommande = ArrayID[2];

		$.ajax({

            type: "GET",
            url : "index.php?page=ajout_produit_manquant",
            data: "idcommande="+IdCommande+"&idproduit="+IdProduit+"",
            //async: false,
            beforeSend: function() {
                $('div#conteneur_popup').show();
                $('div#ChargementsAjax').show();
                $('div#ChargementsAjax p').html('Ajout à la liste des produits manquantes en cours ...');
            },
            success: function(response){

            	var ArrayReponse = new Array;
            	ArrayReponse = response.split('_');

            	var RetourPincking = parseInt(ArrayReponse[0]);
            	var RetourProduitManquant = parseInt(ArrayReponse[1]);

            	if(RetourPincking > 0){
            		$('div#ChargementsAjax p').html('Ajout terminer.Redirection vers le picking');
            		setTimeout(function(){
	            		window.location = 'index.php?page=picking&idcommande='+IdCommande+'';
	            	}, 1000);
            	}else if(RetourProduitManquant > 0){
            		$('div#ChargementsAjax p').html('Ajout terminer.Retour à la liste des produits manquants');
            		setTimeout(function(){
	            		window.location = 'index.php?page=liste_produit&idcommade='+IdCommande+''; 
	            	}, 1000);
            	}else{
            		$('div#ChargementsAjax p').html('Ajout terminer.Retour à la liste des commandes');
            		setTimeout(function(){
	            		window.location = 'index.php?idcommande='+IdCommande+'';
	            	}, 1000);
            	}
            },
            error: function(){
                $('div#conteneur_popup').show();
                $('div#ChargementsAjax').show();
                $('div#ChargementsAjax p').html('Erreur lors d\'ajout');
            }
        });
	});
});