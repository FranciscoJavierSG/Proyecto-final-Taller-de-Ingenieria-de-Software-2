<?php

//http://localhost/apiRest/public/publicacion_aprobada
//https://edein.cl/equipo2/apiRest/public/publicacion_aprobada
$url = 'https://edein.cl/equipo2/apiRest/public/publicacion_aprobada';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response=json_decode($response_json, true);
//echo '<pre>'; print_r($response); echo '</pre>';
//print_r($response);
?>
<a href="menu.php">
<input name="submit" type="submit" value="Volver" class="btn solid" />
</a>
 
 <hr>
 <h1>ESTAS SON LAS PUBLICACIONES QUE ESTAN APROBADAS</h1>
 <hr>
<?php
foreach($response as $key => $result) {
     //Hay que adaptar los div si sobra tiempo
    echo '<div>';
    echo 'Id de publicacion : ';
    echo $result['id_publicacion'], '<br>';
    echo 'Nombre de publicacion : ';
    echo $result['nombre_publicacion'], '<br>';
    echo 'Descripcion publicacion : ';
    echo $result['descripcion_publicacion'], '<br>';
    echo 'Valor publicacion : ';
    echo $result['valor_publicacion'], '<br>';
    echo 'Tipo publicacion : ';
    echo $result['tipo_publicacion'], '<br>';
    echo 'Estado : ';
    echo $result['estado'], '<br>';
    echo 'Tipo turismo : ';
    echo $result['tipo_turismo'], '<br>';
    echo 'Email contacto : ';
    echo $result['email_contacto'], '<br>';
    echo 'Telefono contacto : ';
    echo $result['telefono_contacto'], '<br>';
    echo 'Direccion : ';
    echo $result['direccion'], '<br>';
    echo 'Comuna publicacion : ';
    echo $result['comuna_publicacion'], '<br>';
    echo 'Calificacion publicacion : ';
    echo $result['calificacion_publicacion'], '<br>';
    
    echo 'Visitas : ';
    echo $result['visitas'], '<br>';

    //Hay que adaptar los div si sobra tiempo 
    echo '</div>'; ?>
    <a href="aprobada.php?varname=<?php echo $result['id_publicacion'] ?>">
    <?php
    echo '<input name="submit" type="submit" value="Aprobar publicacion: '.$result['id_publicacion'].'" class="btn solid" />';
    ?>
    </a>


    <a href="rechazada.php?varname=<?php echo $result['id_publicacion'] ?>">
    <?php
    echo '<input name="submit" type="submit" value="Rechazar publicacion: '.$result['id_publicacion'].'" class="btn solid" />';
    ?>
    </a>
    
    <?php
    echo '<div>';
    
    echo '</div>';
    echo '<hr>';
       
}
echo "Desde aqui no quedan mas publicaciones que revisar";
?>
