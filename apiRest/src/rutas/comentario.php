<?php
error_reporting(-1);
ini_set('display_errors', 1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;




// GET Lista de una publicacion especifica por ID 
$app->get('/comentario/{id_publicacion}', function(Request $request, Response $response){
    $id_publicacion = $request->getAttribute('id_publicacion');
    $sql = "SELECT * FROM comentario WHERE id_publicacion = '$id_publicacion' ORDER BY likes DESC";
    try{
      $db = new db();
      $db = $db->conectionDB();
      $result = $db->query($sql);
  
      if ($result->rowCount() > 0){
        $publicacion = $result->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($publicacion);
      }else {
        echo "No existen publicaciones en la BBDD con este ID.";
      }
      $result = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
  }); 


$app->post('/comentario/new', function(Request $request, Response $response){
    //$id_comentario = $request->getAttribute('id_comentario');
    $comentario = $request->getParam('comentario');
    $id_publicacion = $request->getParam('id_publicacion');    
    $id_usuario = $request->getParam('id_usuario');    
    $likes = $request -> getParam('likes');
       

    $sql= "INSERT INTO comentario (comentario, id_publicacion, id_usuario, likes) 
    VALUES (:comentario, :id_publicacion, :id_usuario ,:likes )";

    try{
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> prepare ($sql);

        //$result->bindParam(':id_review',$id_review);
        $result->bindParam(':comentario',$comentario);
        $result->bindParam(':id_publicacion',$id_publicacion);
        $result->bindParam(':id_usuario',$id_usuario);
        $result->bindParam(':likes',$likes);
    
        

        $result->execute();
        echo json_encode("comentario Guardada");
        $result=null;
        $db=null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }

});


$app->post('/comentario/like', function(Request $request, Response $response){
    $id_comentario = $request->getParam('id_comentario');
     
       
    $sql = "UPDATE comentario 
            SET likes = likes+1 
            WHERE id_comentario = '$id_comentario'";

    /*$sql= "INSERT INTO comentario (comentario, id_publicacion, id_usuario) 
    VALUES (:comentario, :id_publicacion, :id_usuario)";*/

    try{
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> prepare ($sql);

        //$result->bindParam(':id_review',$id_review);
        
        $result->bindParam(':id_comentario',$id_comentario);
        
        
    
        

        $result->execute();

        $count = $result->rowCount();
        if($count>0){
          echo "Ta bueno";
        } else{
          echo "ta malo";
        }
       
        $result=null;
        $db=null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }

});

$app->post('/comentario/dislike', function(Request $request, Response $response){
  $id_comentario = $request->getParam('id_comentario');
      
  $sql = "UPDATE comentario 
          SET likes = likes-1 
          WHERE id_comentario = '$id_comentario'";

try{
  $db = new db();
  $db = $db -> conectionDB();
  $result = $db -> prepare ($sql);

  //$result->bindParam(':id_review',$id_review);
  
  $result->bindParam(':id_comentario',$id_comentario);
  
  $result->execute();

  $count = $result->rowCount();
  if($count>0){
    echo "Ta bueno";
  } else{
    echo "ta malo";
  }
 
  $result=null;
  $db=null;
}catch(PDOException $e){echo '{"error" : {"text":'.$e->getMessage().'}'; 
}

});