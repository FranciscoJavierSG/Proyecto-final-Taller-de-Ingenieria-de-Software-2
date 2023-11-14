<?php
//Using GET
$var_value = $_GET['varname'];

$postdata = array ( 
    "id_review" => $var_value 
);

echo 'Haz rechazado la reseña: '.$var_value.'';
print_r($postdata);

$postdata = json_encode($postdata);
echo $postdata;
//http://localhost/apiRest/public/rechazar_resena
//https://edein.cl/equipo2/apiRest/public/rechazar_resena
$url ="https://edein.cl/equipo2/apiRest/public/rechazar_resena";
$curl = curl_init($url);

//curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
$postResult = curl_exec($curl); 

if (curl_errno($curl)) { 
   print curl_error($curl); 
} 
curl_close($curl); 
echo "<pre> $postResult</pre>";

echo "Review Aprobada";
?>

<a href="resena_rechazada.php">
<input name="submit" type="submit" value="Volver" class="btn solid" />