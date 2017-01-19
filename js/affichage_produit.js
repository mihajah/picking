$(document).ready(function(){
	$(document).on('click', 'button.retour_liste_produit', function(){
		var ID = $(this).attr('id');
		var ArrayID = new Array;
		ArrayID = ID.split('_');
		window.location = 'index.php?page=liste_produit&idcommade='+ArrayID[1]+'';
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
            	var response = parseInt(response);
            	if(response > 0){
            		$('div#ChargementsAjax p').html('Ajout manuel terminer.');
            		setTimeout(function(){
	            		window.location = 'index.php?page=picking&idcommande='+idCommande+'';
	            	}, 3000);
            	}else{
            		$('div#ChargementsAjax p').html('Ajout manuel terminer.Retour à la liste des commandes');
            		setTimeout(function(){
	            		window.location = 'index.php?idcommande='+idCommande+'';
	            	}, 3000);
            	}
            },
            error: function(){
                $('div#conteneur_popup').show();
                $('div#ChargementsAjax').show();
                $('div#ChargementsAjax p').html('Erreur de chargement');
            }
        });
	});
});