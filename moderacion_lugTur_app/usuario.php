<?php


//http://localhost/apiRest/public/usuario_no_oferente
//https://edein.cl/equipo2/apiRest/public/usuario_no_oferente
$url = 'https://edein.cl/equipo2/apiRest/public/usuario_no_oferente';
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
 <h1>Vea que usuarios volver oferente</h1>
 <hr>
<?php



foreach($response as $key => $result) {
     //Hay que adaptar los div si sobra tiempo
    echo '<div>';
    echo 'Id de usuario : ';
    echo $result['id_usuario'], '<br>';
    echo 'Nombre de usuario : ';
    echo $result['nombre_usuario'], '<br>';
    echo 'Email usuario : ';
    echo $result['email_usuario'], '<br>';
    
    

    //Hay que adaptar los div si sobra tiempo 
    echo '</div>'; ?>
    <a href="volver_oferente.php?varname=<?php echo $result['id_usuario'] ?>">
    <?php
    echo '<input name="submit" type="submit" value="Volver usuario normal: '.$result['id_usuario'].'" class="btn solid" />';
    ?>
    </a>


    
    <?php
    echo '<div>';
    
    echo '</div>';
    echo '<hr>';
        
}
echo "Desde aqui no quedan mas usuarios que revisar";
?>
