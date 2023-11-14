<?php
error_reporting(-1);
ini_set('display_errors', 1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


// Get publicaciones guardadas

$app->get('/publicaciones_guardadas/{id_usuario}', function(Request $request, Response $response){
    $id_usuario = $request->getAttribute('id_usuario');

    $sql="SELECT * FROM usuario, publicacion, guarda
    WHERE usuario.id_usuario ='$id_usuario'
    AND usuario.id_usuario = guarda.id_usuario
    AND guarda.id_publicacion = publicacion.id_publicacion
    AND publicacion.estado = 'aprobado'";

    try{

        $db = new db();
        $db = $db->conectionDB();
        $result = $db->query($sql);
    
        if ($result->rowCount() > 0){
          $usuario = $result->fetchAll(PDO::FETCH_OBJ);
          echo json_encode($usuario);
        }else {
         
            echo "No existen usuarios en la BBDD con este ID.";
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

// Guardar una publicacion


$app->post('/guardar_publicacion/new', function(Request $request, Response $response){
    
    $id_usuario = $request->getParam('id_usuario');
    $id_publicacion = $request->getParam('id_publicacion');
   
    $sql="INSERT INTO guarda(id_usuario, id_publicacion)
    VALUES (:id_usuario,:id_publicacion)";

    /*$sql= "INSERT INTO usuario(id_usuario,nombre_usuario,email_usuario,contrasena) 
    VALUES (:id_usuario,:nombre_usuario,:email_usuario,:contrasena)";
*/

    try{
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> prepare ($sql);

        $result->bindParam(':id_usuario',$id_usuario);
        $result->bindParam(':id_publicacion',$id_publicacion);

        $result->execute();
        echo json_encode("Usuario Guardado");
        $result=null;
        $db=null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }

});


$app->delete('/guardar_publicacion/delete/{id_usuario}', function(Request $request, Response $response){
    
    $id_usuario = $request ->getAttribute('id_usuario');
    
    $sql="DELETE FROM guarda WHERE id_usuario = '$id_usuario'";
    
        try{
            $db = new db();
            $db = $db -> conectionDB();
            $result = $db -> prepare ($sql);
            $result -> execute();
    
    
            if($result ->rowCount()>0){
                echo json_encode("Publicaciones guardadas eliminadas");
            }else{
                echo json_encode("No existe este usuario en la BBDD");
            }
    
        }catch(PDOException $e){
            echo '{"error" : {"text":'.$e->getMessage().'}'; 
        }
    
    });