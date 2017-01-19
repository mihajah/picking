$(document).ready(function(){
	$(document).on('click', 'button.liste_produit', function(){
		var ID = $(this).attr('id');
		var ArrayID = new Array;
		ArrayID = ID.split('_');
		
		window.location = 'index.php?page=liste_produit&idcommade='+ArrayID[1]+''; 
	});
});