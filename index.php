<?php
//Activer la gestion des sessions
session_start();

/** MAIN CONTROLLERS **/
if(isset($_GET['page'])){

	$page = $_GET['page'];

	if($_GET['page'] == 'crontask'){
		if (file_exists("cron/cron.php")) {
			include("cron/cron.php");
		}else{
			include("view/404.php");
		}
	}else{
		if(file_exists("controller/".$page.".php")) {
			include("controller/".$page.".php");
		}else{
			include("view/404.php");
		}
	}
	
}else{
	include("controller/liste_commande.php");
}
?>