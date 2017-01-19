$(document).ready(function(){
	$(document).on('click', 'button.retour_liste_commande', function(){
		window.location = 'index.php?page=liste_commande'; 
	});

	$(document).on('click', 'tr.Ligne', function(){
		var ID = $(this).attr('id'); 
		var ArrayID = Array;
		ArrayID = ID.split('_');
		window.location = 'index.php?page=affichage_produit&id='+ArrayID[1]+'&idcommande='+ArrayID[2]+'';
	});

	$(document).on('click', 'button.picking', function(){
		//On initialise la liste des produits pour mode picking
		var ID = $(this).attr('id');
		var ArrayID = new Array;
		ArrayID = ID.split('_');
		var idcommande = ArrayID[1];

		$('div#conteneur_popup').show();
        $('div#ChargementsAjax').show();

		$.ajax({
            type: "GET",
            url : "index.php?page=mode_picking",
            data: "idcommande="+idcommande+"",
            //async: false,
            beforeSend: function() {
                $('div#conteneur_popup').show();
                $('div#ChargementsAjax').show();
            },
            success: function(response){
            	$('div#ChargementsAjax p').html('Initialisation terminer');
            	setTimeout(function(){
            		window.location = 'index.php?page=picking&idcommande='+idcommande+'';
            	}, 3000);
            },
            error: function(){
                $('div#conteneur_popup').show();
                $('div#ChargementsAjax').show();
                $('div#ChargementsAjax p').html('Erreur de chargement');
            }
        }); 
	});

    $(document).on('click', 'button.prochaine_commande', function(){
        var ID = $(this).attr('id');
        var ArrayID = new Array;
        ArrayID = ID.split('_'); 
        window.location = 'index.php?idcommande='+ArrayID[1]+'';
    });
});