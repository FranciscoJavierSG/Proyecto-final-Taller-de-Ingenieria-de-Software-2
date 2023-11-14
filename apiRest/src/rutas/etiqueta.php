<?php
error_reporting(-1);
ini_set('display_errors', 1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

//GET de todas las etiqueta
$app->get('/etiqueta/{id}', function (Request $request, Response $response){
    $id_publicacion = $request->getAttribute('id');

    
    $sql = "SELECT * FROM etiqueta WHERE id_publicacion='$id_publicacion'";
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $usuarios = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($usuarios);

        }else{
            echo "No hay usuarios aun!.";
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 

//GET de todas las etiqueta
$app->get('/etiqueta_publicacion/{id_etiqueta}', function (Request $request, Response $response){
    $id_etiqueta = $request->getAttribute('id_etiqueta');

    $sql = "SELECT etiqueta FROM etiqueta WHERE id_etiqueta = '$id_etiqueta'"; 

    
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $value = $result -> fetch (PDO::FETCH_OBJ);
            $etiqueta = $value->etiqueta;
            $result =null;


            $sql2 = "SELECT * FROM etiqueta, publicacion 
            WHERE etiqueta='$etiqueta' 
            AND etiqueta.id_publicacion = publicacion.id_publicacion
            AND publicacion.estado = 'aprobado'";
            
            $result = $db -> query($sql2);
            if($result -> rowCount() > 0){
                $usuarios = $result->fetchAll (PDO::FETCH_OBJ);
                echo json_encode($usuarios);
            }
            

        }else{
            echo "No hay publicaciones aun!.";
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 

//POST Agregar nueva etiqueta
$app->post('/etiqueta/new', function(Request $request, Response $response){
    
    $etiqueta = $request->getParam('etiqueta');
    $id_publicacion = $request->getParam('id_publicacion');
   
    $sql= "SELECT * FROM etiqueta 
    WHERE etiqueta = '$etiqueta' AND id_publicacion ='$id_publicacion'";

    $sql2="INSERT INTO etiqueta (id_publicacion,  etiqueta) 
    VALUES (:id_publicacion, :etiqueta)";

    try{
       
        $etiqueta_check = preg_match('~^\#[a-zA-Z0-9]{2,20}$~i', $etiqueta);
        if ($etiqueta_check>0){
            $db = new db();
            $db = $db -> conectionDB();
            $result = $db -> prepare ($sql);
            $result->bindParam(':etiqueta',$etiqueta);
            $result->bindParam(':id_publicacion',$id_publicacion);
            
            $result->execute();

            $count = $result ->rowCount();
            if($count > 0){
                echo "ETIQUETA NO VALIDA";
            }else{
                
                $result = $db -> prepare ($sql2);
                $result ->bindParam ('etiqueta',$etiqueta);
                $result ->bindParam ('id_publicacion',$id_publicacion);

                $result -> execute();
                echo json_encode("Etiqueta Guardada");
            }
           
            $result=null;
            $db=null;
        }else {
            echo "Etiqueta no valida";
        }
       
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }

});
