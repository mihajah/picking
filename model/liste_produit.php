<?php
//On recupere tous les produits de la commande
function orders($id){
        // create curl resource
        $ch = curl_init();

        //set url
        curl_setopt($ch, CURLOPT_URL, "www.touchiz.fr/ws/orders/".$id."");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //$output contains the output string
        $output = curl_exec($ch);

        //close curl resource to free up system resources
        curl_close($ch);

        return json_decode($output, true);
}

//On recupere les informations de chaques produits
function products($id){
        // create curl resource
        $ch = curl_init();

        //set url
        curl_setopt($ch, CURLOPT_URL, "www.touchiz.fr/ws/products/".$id."");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //$output contains the output string
        $output = curl_exec($ch);

        //close curl resource to free up system resources
        curl_close($ch);

        return json_decode($output, true);
}

//On recupere les informations de chaques produits de la liste
function getProductsList(array $listeProduct){
        $ListeProducts = array();
        foreach($listeProduct as $idProduct){
                $ListeProducts[] = products($idProduct);
        }
        return $ListeProducts;
}
?>
