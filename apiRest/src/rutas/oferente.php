<?php
error_reporting(-1);
ini_set('display_errors', 1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

//GET de todas las publicaciones

$app->get('/oferente', function (Request $request, Response $response){
    
    
    $sql = "SELECT * FROM oferente";
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $usuarios = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($usuarios);

        }else{
            echo json_encode("No hay usuarios aun!.");
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 

// GET Lista de una publicacion especifica por ID 
$app->get('/oferente/{id}', function(Request $request, Response $response){
    $id_usuario = $request->getAttribute('id');
    $sql = "SELECT * FROM oferente WHERE usuario = '$id_usuario'";
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


// GET Lista de una publicacion especifica por ID 
$app->get('/usuario_oferente', function(Request $request, Response $response){
    //$id_usuario = $request->getAttribute('id');
    $sql = "SELECT id_usuario,nombre_usuario,email_usuario FROM oferente, usuario WHERE oferente.usuario= usuario.id_usuario";
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
// GET Lista de una publicacion especifica por ID 
$app->get('/usuario_no_oferente', function(Request $request, Response $response){
    //$id_usuario = $request->getAttribute('id');
    $sql = "SELECT DISTINCT (id_usuario),nombre_usuario,email_usuario 
    FROM usuario WHERE id_usuario NOT IN (SELECT * FROM oferente) ";
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
//POST Agregar nueva publicacion

$app->post('/oferente/new', function(Request $request, Response $response){
    
    $usuario = $request->getParam('usuario');
    
     

    $sql= "INSERT INTO oferente (usuario) 
    VALUES (:usuario)";

    try{
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> prepare ($sql);

        $result->bindParam(':usuario',$usuario);
       
        


        $result->execute();
        echo json_encode("Usuario Guardado");
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

$app->post('/oferente/delete', function(Request $request, Response $response){
    $usuario = $request->getParam('usuario');
    $sql = "DELETE FROM oferente WHERE usuario = '$usuario'";

    try{
        $db = new db();
        $db = $db->conectionDB();
        $result = $db->prepare($sql);
        $result -> execute();

        //eliminar tambien las publicaciones del oferente

        if($result->rowCount()>0){
            echo json_encode("Usuario Eliminado");
        }else{
            echo json_encode("No existe esta publicacion en la BBDD.");
        }

    }catch(PDOException $e){
    echo '{"error" : {"text":'.$e->getMessage().'}';
  }
});
