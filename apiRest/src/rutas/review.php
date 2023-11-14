<?php
error_reporting(-1);
ini_set('display_errors', 1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


/*
// GET Lista de una publicacion especifica por ID 
$app->get('/review/{id_publicacion}', function(Request $request, Response $response){
    $id_publicacion = $request->getAttribute('id_publicacion');
    $sql = "SELECT * FROM review WHERE id_publicacion = '$id_publicacion'";
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
  }); */


$app->post('/review/new', function(Request $request, Response $response){
    //$id_review = $request->getAttribute('id_review');
    $review = $request->getParam('review');
    $id_publicacion = $request->getParam('id_publicacion');    
    $id_usuario = $request->getParam('id_usuario');    
    $estado = $request->getParam('estado');   
    $calificacion_review = $request->getParam('calificacion_review');  


    $sql= "INSERT INTO review (review, id_publicacion, id_usuario, estado, calificacion_review) 
    VALUES (:review, :id_publicacion, :id_usuario, :estado, :calificacion_review)";

    try{
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> prepare ($sql);

        //$result->bindParam(':id_review',$id_review);
        $result->bindParam(':review',$review);
        $result->bindParam(':id_publicacion',$id_publicacion);
        $result->bindParam(':id_usuario',$id_usuario);
        $result->bindParam(':estado',$estado);
        $result->bindParam(':calificacion_review',$calificacion_review);
        

        $result->execute();
        echo json_encode("review Guardada");
        $result=null;
        $db=null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }

});

// GET Lista de una publicacion especifica por ID 
$app->get('/review/{id_publicacion}', function(Request $request, Response $response){
  $id_publicacion = $request->getAttribute('id_publicacion');
  $sql = "SELECT * FROM review, usuario 
  WHERE id_publicacion = '$id_publicacion' 
  AND usuario.id_usuario = review.id_usuario
  AND review.estado='aprobado'";
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
