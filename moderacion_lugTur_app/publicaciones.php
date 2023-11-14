<?php

$url = 'http://localhost/apiRest/public/publicacion';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response = json_decode($response_json, true);
//echo '<pre>'; print_r($response); echo '</pre>';
//print_r($response);

echo '<input name="submit" type="submit" value="Volver" class="btn solid" />';
echo '<hr>';
echo '<h1>ESTAS SON LAS PUBLICACIONES QUE TIENE ASIGNADAS POR REVISAR</h1>';
echo '<hr>';
foreach ($response as $key => $result) {
    //Hay que adaptar los div si sobra tiempo
    echo '<div>';
    echo 'Id de publicación: ';
    echo $result['id_publicacion'], '<br>';
    echo 'Nombre de publicación: ';
    echo $result['nombre_publicacion'], '<br>';
    echo 'Descripción publicación: ';
    echo $result['descripcion_publicacion'], '<br>';
    echo 'Valor publicación: ';
    echo $result['valor_publicacion'], '<br>';
    echo 'Tipo publicación: ';
    echo $result['tipo_publicacion'], '<br>';
    echo 'Estado: ';
    echo $result['estado'], '<br>';
    echo 'Tipo turismo: ';
    echo $result['tipo_turismo'], '<br>';
    echo 'Email contacto: ';
    echo $result['email_contacto'], '<br>';
    echo 'Teléfono contacto: ';
    echo $result['telefono_contacto'], '<br>';
    echo 'Dirección: ';
    echo $result['direccion'], '<br>';
    echo 'Redes sociales: ';
    echo $result['redes_sociales'], '<br>';
    echo 'Comuna publicación: ';
    echo $result['comuna_publicacion'], '<br>';
    echo 'Calificación publicación: ';
    echo $result['calificacion_publicacion'], '<br>';
    echo 'Visitas: ';
    echo $result['visitas'], '<br>';

    //Hay que adaptar los div si sobra tiempo 
    echo '</div>';
    echo '<div>';
    echo '<a href="aprobada.php">';
    echo '<input name="submit" type="submit" value="Aprobar" class="btn solid" />';
    echo '</a>';

    echo '<a href="rechazada.php">';
    echo '<input name="submit" type="submit" value="Rechazar" class="btn solid" />';
    echo '</a>';

    echo '</div>';
    echo '<hr>';
}
