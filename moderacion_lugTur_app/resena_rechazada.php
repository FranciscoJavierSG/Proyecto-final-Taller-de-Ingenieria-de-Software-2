<?php

//http://localhost/apiRest/public/resena_rechazada
//https://edein.cl/equipo2/apiRest/public/resena_rechazada
$url = 'https://edein.cl/equipo2/apiRest/public/resena_rechazada';
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
 <h1>ESTAS SON LAS RESENAS QUE ESTAN RECHAZADAS</h1>
 <hr>
<?php
foreach($response as $key => $result) {
     //Hay que adaptar los div si sobra tiempo
    echo '<div>';
    echo 'Id de review : ';
    echo $result['id_review'], '<br>';
    echo 'Nombre de review : ';
    echo $result['review'], '<br>';
    echo 'Id de publicacion : ';
    echo $result['id_publicacion'], '<br>';
    echo 'Valor publicacion : ';
    echo $result['valor_publicacion'], '<br>';
    echo 'Estado : ';
    echo $result['estado'], '<br>';
    echo 'Calificacion de review : ';
    echo $result['calificacion_review'], '<br>';
    

    //Hay que adaptar los div si sobra tiempo 
    echo '</div>'; ?>
     <a href="aprobar_resena.php?varname=<?php echo $result['id_review'].'&var='.$result['id_publicacion'] ?>">
    <?php
    echo '<input name="submit" type="submit" value="Aprobar resena: '.$result['id_review'].'" class="btn solid" />';
    ?>
    </a>


    <a href="rechazar_resena.php?varname=<?php echo $result['id_review'].'&var='.$result['id_publicacion'] ?>">
    <?php
    echo '<input name="submit" type="submit" value="Rechazar publicacion: '.$result['id_review'].'" class="btn solid" />';
    ?>
    </a>
    
    <?php
    echo '<div>';
    
    echo '</div>';
    echo '<hr>';
    
}
echo "Desde aqui no quedan mas reseñas que revisar";
?>
