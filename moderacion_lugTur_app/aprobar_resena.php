<?php
//Using GET
$var_value = $_GET['varname'];
$var_value2 = $_GET['var'];

$postdata = array ( 
    "id_review" => $var_value,
    "id_publicacion" => $var_value2
);

echo 'Haz aprobado la reseña: '.$var_value.'';
print_r($postdata);

$postdata = json_encode($postdata);
echo $postdata;
//http://localhost/apiRest/public/aprobar_resena
//https://edein.cl/equipo2/apiRest/public/aprobar_resena
$url ="https://edein.cl/equipo2/apiRest/public/aprobar_resena";
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

<a href="resena_aprobada.php">
<input name="submit" type="submit" value="Volver" class="btn solid" />