<?php
error_reporting(-1);
ini_set('display_errors', 1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



//GET de todas las publicaciones

$app->get('/usuario', function (Request $request, Response $response){
    
    
    $sql = "SELECT * FROM usuario";
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

// GET Lista de un usuario especifica por ID 
$app->get('/usuario/{id_usuario}', function(Request $request, Response $response){
    $id_usuario = $request->getAttribute('id_usuario');
   
    $sql = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'";
    try{
        
      $db = new db();
      $db = $db->conectionDB();
      $result = $db->query($sql);
      
      if ($result->rowCount() > 0){
        $usuarios = $result->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($usuarios);
      }else {
        echo json_encode("No existen usuarios en la BBDD con este ID.");
      }
      $result = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
  }); 

//POST Agregar nueva usuario
/*
$app->post('/usuario/new', function(Request $request, Response $response){
    
    $id_usuario = $request->getParam('id_usuario');
    $nombre_usuario = $request->getParam('nombre_usuario');
    $email_usuario = $request->getParam('email_usuario');
    $contrasena = $request->getParam('contrasena');
     

    $sql= "INSERT INTO usuario(id_usuario,nombre_usuario,email_usuario,contrasena) 
    VALUES (:id_usuario,:nombre_usuario,:email_usuario,:contrasena)";

    try{
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> prepare ($sql);

        $result->bindParam(':id_usuario',$id_usuario);
        $result->bindParam(':nombre_usuario',$nombre_usuario);
        $result->bindParam(':email_usuario',$email_usuario);
        $result->bindParam(':contrasena',$contrasena);
        


        $result->execute();
        echo json_encode("Usuario Guardado");
        $result=null;
        $db=null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }

});
*/
/*//PUT Editar usuario

$app->put('/usuario/editar/{usuario}', function(Request $request, Response $response){
    
    $usuario = $request->getAttribute('usuario');
    $nombre_usuario = $request->getAttribute('nombre_usuario');
    $email_usuario = $request->getAttribute('email_usuario');
    $contraseña = $request->getAttribute('contraseña');
     
    

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
});*/


//DELETE borrar publicacion

$app->delete('/usuario/delete/{usuario}', function(Request $request, Response $response){
    $id_usuario = $request->getAttribute('usuario');
    $sql = "DELETE FROM usuario WHERE usuario = $id_usuario";

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


$app->get('/mis_publicaciones/{id_usuario}', function (Request $request, Response $response){
    $id_usuario = $request->getAttribute('id_usuario');


    $sql = "SELECT * FROM  publicacion, publica, oferente, usuario  
    WHERE usuario.id_usuario='$id_usuario' 
    AND usuario.id_usuario = oferente.usuario
    AND oferente.usuario = publica.id_oferente
    AND publica.id_publicacion = publicacion.id_publicacion";

    
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $usuarios = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($usuarios);

        }else{
            echo json_encode("Este usuario no tiene publicaciones publicadas!.");
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 

$app->get('/usuario_publicacion/{id_usuario}', function (Request $request, Response $response){
    $id_usuario = $request->getAttribute('id_usuario');


    $sql = "SELECT * FROM  publicacion, publica, oferente, usuario  
    WHERE usuario.id_usuario='$id_usuario' 
    AND usuario.id_usuario = oferente.usuario
    AND oferente.usuario = publica.id_oferente
    AND publica.id_publicacion = publicacion.id_publicacion
    AND publicacion.estado= 'aprobado'";

    
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $usuarios = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($usuarios);

        }else{
            echo json_encode("Este usuario no tiene publicaciones publicadas!.");
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 


$app->get('/usuario_foto/{id_usuario}', function (Request $request, Response $response){
    $id_usuario = $request->getAttribute('id_usuario');


    $sql = "SELECT * FROM  imagen_usuario  
    WHERE id_usuario='$id_usuario'";

    
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        
            $usuarios = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($usuarios);

        
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 
//insertar usuario editado

$app->post('/usuario/editar', function(Request $request, Response $response){

    $id_usuario = $request->getParam('id_usuario');
    $contrasena = $request->getParam('contrasena');
    $contrasena=hash('sha256',$contrasena);
    $nombre_usuario = $request->getParam('nombre_usuario');
    $email_usuario = $request->getParam('email_usuario');

    $sql = " UPDATE usuario 
             SET  contrasena ='$contrasena', nombre_usuario ='$nombre_usuario', email_usuario ='$email_usuario'
             WHERE id_usuario = '$id_usuario'";

    try {

        $username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $nombre_usuario);
        $email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email_usuario);
        $password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $contrasena);

        $db = new db();
        $db = $db->conectionDB();
        $result = $db->prepare($sql);

        $result->bindParam(':id_usuario',$id_usuario);
        $contrasena=hash('sha256',$contrasena);
        $result->bindParam(':contrasena',$contrasena);
        $result->bindParam(':nombre_usuario',$nombre_usuario);
        $result->bindParam(':email_usuario',$email_usuario);


        $result->execute();
        echo json_encode("Usuario modificado.");

        $result = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }
});