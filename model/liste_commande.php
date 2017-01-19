<?php
//On recupere tous les commandes
function getOrdersToShip(){
        // create curl resource
        $ch = curl_init();

        //set url
        curl_setopt($ch, CURLOPT_URL, "staging.touchiz.fr/ws/getOrdersToShip");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //$output contains the output string
        $output = curl_exec($ch);

        //close curl resource to free up system resources
        curl_close($ch);

        return json_decode($output, true);
}
?>