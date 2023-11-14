<?php
error_reporting(-1);
ini_set('display_errors', 1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



// POST MODERADOR

//POST APRUEBA review
$app->post('/aprobar_resena', function(Request $request, Response $response){
    $id_review = $request->getParam('id_review');
    $id_publicacion = $request->getParam('id_publicacion');

    $sql="UPDATE review 
        SET estado = 'aprobado'
        WHERE id_review= '$id_review'";
    

    $sql2 = "UPDATE publicacion 
        SET calificacion_publicacion =(SELECT AVG(calificacion_review) 
                                FROM review 
                                WHERE id_publicacion= '$id_publicacion' 
                                AND review.estado = 'aprobado')
        WHERE id_publicacion ='$id_publicacion'";


    /*$sql2 = "SELECT id_publicacion 
            FROM review 
            WHERE id_review= '$id_review'";*/
    try{
      $db = new db();
      $db = $db->conectionDB();
      $result = $db->prepare($sql);

      $result->bindParam(':id_review',$id_review);

      $result->execute();

      $result = $db -> prepare ($sql2);
      $result->bindParam(':id_review',$id_review);
      $result->bindParam(':id_publicacion',$id_publicacion);
     


      $result->execute();
      echo $id_publicacion;
      
     $result = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
  });

  
//POST RECHAZA review
$app->post('/rechazar_resena', function(Request $request, Response $response){
    $id_review = $request->getParam('id_review');
    $id_publicacion = $request->getParam('id_publicacion');

    $sql="UPDATE review 
        SET estado = 'rechazado'
        WHERE id_review= '$id_review'";
     $sql2 = "UPDATE publicacion 
     SET calificacion_publicacion =(SELECT AVG(calificacion_review) 
                             FROM review 
                             WHERE id_publicacion= '$id_publicacion' 
                             AND review.estado = 'aprobado')
     WHERE id_publicacion ='$id_publicacion'";
    //$sql = "SELECT * FROM publicacion WHERE id_publicacion = '$id_publicacion'";
    try{
      $db = new db();
      $db = $db->conectionDB();
      $result = $db->prepare($sql);

      $result->bindParam(':id_review',$id_review);

      $result->execute();

      $result = $db -> prepare ($sql2);
      $result->bindParam(':id_review',$id_review);
      $result->bindParam(':id_publicacion',$id_publicacion);
      $result->execute();  
      echo json_encode("Review Rechazada");
  
     
      $result = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
  });


// POST APRUEBA publicacion
$app->post('/aprobar_publicacion', function(Request $request, Response $response){
    $id_publicacion = $request->getParam('id_publicacion');

    $sql="UPDATE publicacion 
        SET estado = 'aprobado'
        WHERE id_publicacion= '$id_publicacion'";
    //$sql = "SELECT * FROM publicacion WHERE id_publicacion = '$id_publicacion'";
    try{
      $db = new db();
      $db = $db->conectionDB();
      $result = $db->prepare($sql);

      $result->bindParam(':id_publicacion',$id_publicacion);

      $result->execute();
      echo json_encode("Publicacion Aprobada");
  
     /* if ($result->rowCount() > 0){
        $publicacion = $result->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($publicacion);
      }else {
        echo json_encode("No existen publicaciones en la BBDD con este ID.");
      }*/
      $result = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
  }); 
// POST RECHAZA publicacion
$app->post('/rechazar_publicacion', function(Request $request, Response $response){
    $id_publicacion = $request->getParam('id_publicacion');

    $sql="UPDATE publicacion 
        SET estado = 'rechazado'
        WHERE id_publicacion= '$id_publicacion'";
    //$sql = "SELECT * FROM publicacion WHERE id_publicacion = '$id_publicacion'";
    try{
      $db = new db();
      $db = $db->conectionDB();
      $result = $db->prepare($sql);

      $result->bindParam(':id_publicacion',$id_publicacion);

      $result->execute();
      echo json_encode("Publicacion Rechazada");
  
     /* if ($result->rowCount() > 0){
        $publicacion = $result->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($publicacion);
      }else {
        echo json_encode("No existen publicaciones en la BBDD con este ID.");
      }*/
      $result = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
  }); 
//GET DE MODERADOR

$app->get('/publicacion_pendiente',function(Request $reques, Response $response){

    $sql = "SELECT * FROM publicacion WHERE  estado='pendiente' ORDER BY estado ASC";
    //$sql = "SELECT * FROM publicacion  ORDER BY estado ASC";
    try {
        $db = new db();
        $db = $db->conectionDB();

        $result = $db ->query($sql);

        $result ->rowCount();
        if($result ->rowCount()>0){

            $publicaciones = $result -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($publicaciones);

        }else{
            echo json_encode("WOPS");
        }
    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
});

$app->get('/publicacion_rechazada',function(Request $reques, Response $response){

    $sql = "SELECT * FROM publicacion WHERE  estado='rechazado'";
    
    try {
        $db = new db();
        $db = $db->conectionDB();

        $result = $db ->query($sql);

        $result ->rowCount();
        if($result ->rowCount()>0){

            $publicaciones = $result -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($publicaciones);

        }else{
            echo json_encode("WOPS");
        }
    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
});


$app->get('/publicacion_aprobada',function(Request $reques, Response $response){

    $sql = "SELECT * FROM publicacion WHERE  estado='aprobado' ";
   
    try {
        $db = new db();
        $db = $db->conectionDB();

        $result = $db ->query($sql);

        $result ->rowCount();
        if($result ->rowCount()>0){

            $publicaciones = $result -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($publicaciones);

        }else{
            echo json_encode("WOPS");
        }
    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
});

// GET reseñas pendiente
$app->get('/resena_pendiente',function(Request $reques, Response $response){

    $sql = "SELECT * FROM review WHERE  estado='pendiente' ORDER BY estado ASC";
    //$sql = "SELECT * FROM publicacion  ORDER BY estado ASC";
    try {
        $db = new db();
        $db = $db->conectionDB();

        $result = $db ->query($sql);

        $result ->rowCount();
        if($result ->rowCount()>0){

            $review = $result -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($review);

        }else{
            echo json_encode("WOPS");
        }
    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 


// GET reseñas rechazadas
$app->get('/resena_aprobado',function(Request $reques, Response $response){

    $sql = "SELECT * FROM review WHERE  estado='aprobado' ORDER BY estado ASC";
    //$sql = "SELECT * FROM publicacion  ORDER BY estado ASC";
    try {
        $db = new db();
        $db = $db->conectionDB();

        $result = $db ->query($sql);

        $result ->rowCount();
        if($result ->rowCount()>0){

            $review = $result -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($review);

        }else{
            echo json_encode("WOPS");
        }
    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 


// GET reseñas rechazadas
$app->get('/resena_rechazada',function(Request $reques, Response $response){

    $sql = "SELECT * FROM review WHERE  estado='rechazado' ORDER BY estado ASC";
    //$sql = "SELECT * FROM publicacion  ORDER BY estado ASC";
    try {
        $db = new db();
        $db = $db->conectionDB();

        $result = $db ->query($sql);

        $result ->rowCount();
        if($result ->rowCount()>0){

            $review = $result -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($review);

        }else{
            echo json_encode("WOPS");
        }
    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 





//LOGIN MOD


$app->post('/login_moderador',function(Request $request, Response $response){
    $id_usuario = $request->getParam('id_usuario');
    $contrasena = $request->getParam('contrasena');
    $codigo_acceso = $request ->getParam('codigo_acceso');
    $contrasena=hash('sha256',$contrasena);
    $sql = "SELECT id_usuario FROM usuario, moderador 
    WHERE (id_usuario='$id_usuario' OR email_usuario='$id_usuario') 
    AND contrasena ='$contrasena' AND codigo_acceso = '$codigo_acceso'";

    try{
        $db = new db();
        $db = $db -> conectionDB();  
        $data='';
 
        $result = $db -> prepare ($sql);
        $result->bindParam(':id_usuario',$id_usuario);        
        $result->bindParam(':contrasena',$contrasena);
        $result->bindParam(':codigo_acceso',$codigo_acceso);
        $result->execute();
        
        $count = $result->rowCount();
        $data=$result->fetch(PDO::FETCH_OBJ);       

        if(!empty($data)){
            $user_id=$data->id_usuario;
            $data->token = apiToken($user_id);
        }
        $db=null;

        if($data){
            $data=json_encode($data);
            echo '{"data": ' .$data . '}';            
        }else{
            echo '{"error":{"text":"Bad request wrong username and password"}}';
        }
    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}'; 
    }
});


// GET Lista de una publicacion especifica por ID 
$app->get('/moderador/{id}', function(Request $request, Response $response){
    $id_usuario = $request->getAttribute('id');
    $sql = "SELECT * FROM moderador WHERE usuario = '$id_usuario'";
    try{
      $db = new db();
      $db = $db->conectionDB();
      $result = $db->query($sql);
  
      if ($result->rowCount() > 0){
        $usuario = $result->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($usuario);
      }else {
        echo json_encode("No existen usuarios en la BBDD con este ID.");
      }
      $result = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
  }); 

//POST Agregar nueva moderador

$app->post('/moderador/new', function(Request $request, Response $response){
    
    $usuario = $request->getParam('usuario');
    $codigo = $request->getParam('codigo');
    
     

    $sql= "INSERT INTO moderador (usuario, codigo) 
    VALUES (:usuario, :codigo)";

    try{
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> prepare ($sql);

        $result->bindParam(':usuario',$usuario);
        $result->bindParam(':codigo',$codigo);
       
        


        $result->execute();
        echo json_encode("Moderador Guardado");
        $result=null;
        $db=null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }

});

//PUT Editar publicacion
/*
$app->put('/oferente/editar/{usuario}', function(Request $request, Response $response){
    
    $usuario = $request->getAttribute('usuario');
    
     
    

    $sql = "UPDATE usuario 
    SET nombre_usuario =:nombre_usuario,
    email_usuario =:email_usuario,
    contraseña =:contraseña
    WHERE usuario = $usuario";

    try {
        $db = new db();
        $db = $db->conectionBD();
        $result = $db->prepare($sql);

        $result->bindParam(':usuario',$usuario);
        $result->bindParam(':nombre_usuario',$nombre_usuario);
        $result->bindParam(':email_usuario',$email_usuario);
        $result->bindParam(':contraseña',$contraseña);
        
        
        $result->excecute();
        echo json_encode("Usuario modificado.");

        $result = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }
});
*/

//DELETE borrar publicacion

$app->delete('/moderador/delete/{id}', function(Request $request, Response $response){
    $id_usuario = $request->getAttribute('id');
    $sql = "DELETE FROM moderador WHERE usuario = $id_usuario";

    try{
        $db = new db();
        $db = $db->conectionBD();
        $result = $db_>prepare($sql);
        $result = execute();

        if($result->rowCount()>0){
            echo json_encode("Usuario Eliminado");
        }else{
            echo json_encode("No existe esta publicacion en la BBDD.");
        }

    }catch(PDOException $e){
    echo '{"error" : {"text":'.$e->getMessage().'}';
  }
});