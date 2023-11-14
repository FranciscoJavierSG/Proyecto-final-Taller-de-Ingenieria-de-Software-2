<?php
//Using POST
$id_usuario = $_POST['id_usuario'];
$contrasena = $_POST['contrasena'];
$codigo_acceso = $_POST['codigo_acceso'];

$postdata = array (
    "id_usuario" => $id_usuario,
    "contrasena" => $contrasena,
    "codigo_acceso" => $codigo_acceso
);
echo $id_usuario;
echo $contrasena;
echo $codigo_acceso;


//print_r($_POST);
print_r($postdata);

//var_dump($_POST);

$postdata = json_encode($postdata);
echo $postdata;
//http://localhost/apiRest/public/login_moderador
//https://edein.cl/equipo2/apiRest/public/login_moderador
$url ="https://edein.cl/equipo2/apiRest/public/login_moderador";
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

 if($postResult ==='{"error":{"text":"Bad request wrong username and password"}}'){
    echo "fuck";
    header("Location: index.php");
    die();
 }else {
    header("Location: menu.php");
 }
?>