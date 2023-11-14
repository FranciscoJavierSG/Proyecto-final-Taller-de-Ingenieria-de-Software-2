<?php
error_reporting(-1);
ini_set('display_errors', 1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


//GET de todas las publicaciones

$app->get('/publicacion', function (Request $request, Response $response){
    
    
    $sql = "SELECT p.id_publicacion,p.nombre_publicacion,p.descripcion_publicacion,p.valor_publicacion,p.region_publicacion,p.tipo_publicacion,p.estado,
    p.tipo_turismo,p.tipo_turismo,p.email_contacto,p.telefono_contacto,p.direccion,p.comuna_publicacion,p.calificacion_publicacion,p.visitas,imagen_publicacion.base64
    FROM publicacion p LEFT JOIN imagen_publicacion USING(id_publicacion) WHERE estado ='aprobado' ORDER BY p.calificacion_publicacion DESC, p.visitas DESC";
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $publicaciones = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($publicaciones);

        }else{
            echo json_encode("No hay publicaciones aun!.");
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 

//GET publicaciones en orden destacadas

$app->get('/publicacion/destacadas', function (Request $request, Response $response){
    
    
    $sql = "SELECT * FROM publicacion WHERE estado='aprobado' ORDER BY calificacion_publicacion DESC, visitas DESC";
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $publicaciones = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($publicaciones);

        }else{
            echo json_encode("No hay publicaciones aun!.");
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 

//ORDENA POR NOMBRE DE FORMA ASCENDENTE
$app->get('/publicacion_ordenada_ASC', function (Request $request, Response $response){
    
    
    $sql = "SELECT * FROM publicacion WHERE estado='aprobado' ORDER BY nombre_publicacion ASC";
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $publicaciones = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($publicaciones);

        }else{
            echo json_encode("No hay publicaciones aun!.");
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 

//ORDENA POR NOMBRE DE FORMA DESCENDENTE
$app->get('/publicacion_ordenada_DES', function (Request $request, Response $response){
    
    
    $sql = "SELECT * FROM publicacion WHERE estado='aprobado' ORDER BY nombre_publicacion DESC";
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $publicaciones = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($publicaciones);

        }else{
            echo json_encode("No hay publicaciones aun!.");
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 

// GET Lista de una publicacion especifica por ID 
$app->get('/publicacion/{id_publicacion}', function(Request $request, Response $response){
    $id_publicacion = $request->getAttribute('id_publicacion');
    $sql = "SELECT * FROM publicacion WHERE id_publicacion = '$id_publicacion'";
    try{
      $db = new db();
      $db = $db->conectionDB();
      $result = $db->query($sql);
  
      if ($result->rowCount() > 0){
        $publicacion = $result->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($publicacion);
      }else {
        echo json_encode("No existen publicaciones en la BBDD con este ID.");
      }
      $result = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
  }); 

// GET Lista de una publicaciones por parametros 
$app->post('/publicacion/buscar', function(Request $request, Response $response){
    $nombre_publicacion= $request->getParam('nombre_publicacion');
    $region_publicacion= $request->getParam('region_publicacion');
    $comuna_publicacion= $request->getParam('comuna_publicacion');
    $tipo_publicacion= $request->getParam('tipo_publicacion');
    $tipo_turismo= $request->getParam('tipo_turismo');
    
    //$sql = "SELECT * FROM publicacion WHERE nombre_publicacion LIKE '%$nombre_publicacion%' OR region_publicacion='$region_publicacion' OR comuna_publicacion='$comuna_publicacion'";
    $sql = "SELECT * FROM publicacion WHERE IF((''='$nombre_publicacion' AND 'Selecciona'='$region_publicacion' AND 'Selecciona'='$comuna_publicacion' AND 'Selecciona'='$tipo_publicacion' AND 'Selecciona'='$tipo_turismo'),
                                                0,
                                                (IF(''='$nombre_publicacion', 1, nombre_publicacion LIKE '%$nombre_publicacion%')
                                                AND IF('Selecciona'='$region_publicacion', 1, region_publicacion='$region_publicacion')
                                                AND IF('Selecciona'='$comuna_publicacion', 1, comuna_publicacion='$comuna_publicacion')
                                                AND IF('Selecciona'='$tipo_publicacion', 1, tipo_publicacion='$tipo_publicacion')
                                                AND IF('Selecciona'='$tipo_turismo', 1, tipo_turismo='$tipo_turismo')

                                                )
                                            )";
    try{
      $db = new db();
      $db = $db->conectionDB();
      $result = $db->query($sql);
  
      if ($result->rowCount() > 0){
        $publicacion = $result->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($publicacion);
      }else {
        echo json_encode("No existen publicaciones en la BBDD con este ID.");
      }
      $result = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
  });   

//POST Agregar nueva publicacion

$app->post('/publicacion/new', function(Request $request, Response $response){
    $nombre_publicacion = $request->getParam('nombre_publicacion');
    $descripcion_publicacion = $request->getParam('descripcion_publicacion');
    $valor_publicacion = $request->getParam('valor_publicacion');
    $region_publicacion = $request->getParam('region_publicacion');
    $tipo_publicacion = $request->getParam('tipo_publicacion');
    $estado = $request->getParam('estado');
    $tipo_turismo = $request->getParam('tipo_turismo');
    $email_contacto = $request->getParam('email_contacto');
    $telefono_contacto = $request->getParam('telefono_contacto');
    $direccion = $request->getParam('direccion');
     
    $comuna_publicacion = $request->getParam('comuna_publicacion'); 
    $calificacion_publicacion = $request->getParam('calificacion_publicacion'); 
    //$id_moderador = $request->getParam('id_moderador'); 

    $sql= "INSERT INTO publicacion (nombre_publicacion, descripcion_publicacion, valor_publicacion, region_publicacion,
    tipo_publicacion, estado, tipo_turismo, email_contacto, telefono_contacto, direccion, comuna_publicacion,
    calificacion_publicacion) 
    VALUES (:nombre_publicacion, :descripcion_publicacion, :valor_publicacion, :region_publicacion,
    :tipo_publicacion, :estado, :tipo_turismo, :email_contacto, :telefono_contacto, :direccion, :comuna_publicacion,
    :calificacion_publicacion)";

    try{
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> prepare ($sql);

        $result->bindParam(':nombre_publicacion',$nombre_publicacion);
        $result->bindParam(':descripcion_publicacion',$descripcion_publicacion);
        $result->bindParam(':valor_publicacion',$valor_publicacion);
        $result->bindParam(':region_publicacion',$region_publicacion);
        $result->bindParam(':tipo_publicacion',$tipo_publicacion);
        $result->bindParam(':estado',$estado);
        $result->bindParam(':tipo_turismo',$tipo_turismo);
        $result->bindParam(':email_contacto',$email_contacto);
        $result->bindParam(':telefono_contacto',$telefono_contacto);
        $result->bindParam(':direccion',$direccion);
        
        $result->bindParam(':comuna_publicacion',$comuna_publicacion);
        $result->bindParam(':calificacion_publicacion',$calificacion_publicacion);
        $result->bindParam(':id_moderador',$id_moderador);


        $result->execute();
        echo json_encode("Publicacion Guardada");
        $result=null;
        $db=null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }

});
//PUT agregar visita publicacion
$app->get('/publicacion/visita/{id_publicacion}', function(Request $request, Response $response){
    $id_publicacion = $request->getAttribute('id_publicacion');
    $sql = "UPDATE publicacion SET visitas = visitas+1  WHERE id_publicacion = $id_publicacion";

    try{
      $db = new db();
      $db = $db->conectionDB();
      $result = $db->query($sql);
  
      if ($result->rowCount() > 0){
        echo json_encode("Visita agregada.");
      }else {
        echo json_encode("No existe publicacion en la BBDD con este ID.");
      }
      $result = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
  });   
/*
//PUT Editar publicacion

$app->put('/publicacion/editar/{id_publicacion}', function(Request $request, Response $response){
    $id_publicacion = $request->getAttribute('id_publicacion');

    $nombre_publicacion = $request->getAttribute('nombre_publicacion');
    $descripcion_publicacion = $request->getAttribute('descripcion_publicacion');
    $valor_publicacion = $request->getAttribute('valor_publicacion');
    $region_publicacion = $request->getAttribute('region_publicacion');
    $tipo_publicacion = $request->getAttribute('tipo_publicacion');
    $estado = $request->getAttribute('estado');
    $tipo_turismo = $request->getAttribute('tipo_turismo');
    $email_contacto = $request->getAttribute('email_contacto');
    $telefono_contacto = $request->getAttribute('telefono_contacto');
    $direccion = $request->getAttribute('direccion');
    
    $comuna_publicacion = $request->getAttribute('comuna_publicacion'); 
    $calificacion_publicacion = $request->getAttribute('calificacion_publicacion'); 
    

    $sql = "UPDATE publicacion 
    SET nombre_publicacion =:nombre_publicacion,
    descripcion_publicacion =:descripcion_publicacion,
    valor_publicacion =:valor_publicacion,
    region_publicacion =:region_publicacion,
    tipo_publicacion =:tipo_publicacion,
    estado =:estado,
    tipo_turismo =:tipo_turismo,
    email_contacto =:email_contacto,
    telefono_contacto =:telefono_contacto,
    direccion =:direccion,
    
    comuna_publicacion =:comuna_publicacion,
    calificacion_publicacion=:calificacion_publicacion
    WHERE id_publicacion = $id_publicacion";

    try {
        $db = new db();
        $db = $db->conectionBD();
        $result = $db->prepare($sql);

        $result->bindParam(':nombre_publicacion',$nombre_publicacion);
        $result->bindParam(':descripcion_publicacion',$descripcion_publicacion);
        $result->bindParam(':valor_publicacion',$valor_publicacion);
        $result->bindParam(':tipo_publicacion',$tipo_publicacion);
        $result->bindParam(':estado',$estado);
        $result->bindParam(':tipo_turismo',$tipo_turismo);
        $result->bindParam(':email_contacto',$email_contacto);
        $result->bindParam(':telefono_contacto',$telefono_contacto);
        $result->bindParam(':direccion',$direccion);
        
        $result->bindParam(':comuna_publicacion',$comuna_publicacion);
        $result->bindParam(':calificacion_publicacion',$calificacion_publicacion);
        
        $result->excecute();
        echo json_encode("Publicacion modificada.");

        $result = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }
});
*/
//PUT Editar publicacion

$app->post('/publicacion/editar', function(Request $request, Response $response){
    
    $id_publicacion = $request->getParam('id_publicacion');

    $nombre_publicacion = $request->getParam('nombre_publicacion');
    $descripcion_publicacion = $request->getParam('descripcion_publicacion');
    $valor_publicacion = $request->getParam('valor_publicacion');
    $region_publicacion = $request->getParam('region_publicacion');
    $tipo_publicacion = $request->getParam('tipo_publicacion');
    //$estado = 'pendiente'; 
    $tipo_turismo = $request->getParam('tipo_turismo');
    $email_contacto = $request->getParam('email_contacto');
    $telefono_contacto = $request->getParam('telefono_contacto');
    $direccion = $request->getParam('direccion');
    
    $comuna_publicacion = $request->getParam('comuna_publicacion');
  


     
    

    $sql = "UPDATE publicacion 
    SET nombre_publicacion ='$nombre_publicacion',
    descripcion_publicacion ='$descripcion_publicacion',
    valor_publicacion ='$valor_publicacion',
    region_publicacion ='$region_publicacion',
    tipo_publicacion ='$tipo_publicacion',
    estado ='pendiente',
    tipo_turismo ='$tipo_turismo',
    email_contacto ='$email_contacto',
    telefono_contacto ='$telefono_contacto',
    direccion ='$direccion',
    
    comuna_publicacion ='$comuna_publicacion'
    WHERE id_publicacion = '$id_publicacion'";

    try {
        $db = new db();
        $db = $db->conectionDB();
        $result = $db->prepare($sql);

        $result->bindParam(':id_publicacion',$id_publicacion);
        $result->bindParam(':nombre_publicacion',$nombre_publicacion);
        $result->bindParam(':descripcion_publicacion',$descripcion_publicacion);
        $result->bindParam(':valor_publicacion',$valor_publicacion);
        $result->bindParam(':tipo_publicacion',$tipo_publicacion);
        //$result->bindParam(':estado',$estado);
        $result->bindParam(':tipo_turismo',$tipo_turismo);
        $result->bindParam(':email_contacto',$email_contacto);
        $result->bindParam(':telefono_contacto',$telefono_contacto);
        $result->bindParam(':direccion',$direccion);
        
        $result->bindParam(':comuna_publicacion',$comuna_publicacion);
        
        $result->execute();
        echo json_encode("Publicacion modificada.");

        $result = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }
});

//DELETE borrar publicacion

$app->delete('/publicacion/delete/{id_publicacion}', function(Request $request, Response $response){
    $id_publicacion = $request->getAttribute('id_publicacion');
    $sql = "DELETE FROM publicacion WHERE id_publicacion = '$id_publicacion'";

    try{
        $db = new db();
        $db = $db->conectionDB();
        $result = $db -> prepare ($sql);
        $result -> execute();

        if($result->rowCount()>0){
            echo json_encode("Publicacion Eliminada");
        }else{
            echo json_encode("No existe esta publicacion en la BBDD.");
        }

    }catch(PDOException $e){
    echo '{"error" : {"text":'.$e->getMessage().'}';
  }
});
$app->post('/ultima_publicacion', function (Request $request, Response $response){
    $sql = "SELECT MAX(id_publicacion) AS max_id_publicacion FROM publicacion";

    try{

        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $publicaciones = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($publicaciones);
            echo '{"data": ' .$data . '}';    

        }else{
            echo json_encode("No hay publicaciones aun!.");
        }
        $result = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
});

$app->get('/publicacion_detallada/{id_publicacion}', function (Request $request, Response $response){
    $id_publicacion = $request->getAttribute('id_publicacion');
    
    $sql = "SELECT * FROM publicacion, publica, oferente, usuario 
    WHERE publicacion.id_publicacion = '$id_publicacion'
    AND publicacion.id_publicacion = publica.id_publicacion
    AND publica.id_oferente = oferente.usuario
    AND oferente.usuario = usuario.id_usuario
    ORDER BY visitas DESC";
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $publicaciones = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($publicaciones);

        }else{
            echo json_encode("No hay publicaciones aun!.");
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 

$app->get('/publicacion/publicacion_similar/{id_publicacion}', function (Request $request, Response $response){
    $id_publicacion = $request->getAttribute('id_publicacion');
    
    $sql = "SELECT 	* FROM publicacion 
    WHERE id_publicacion = '$id_publicacion'";
    
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $value = $result -> fetch (PDO::FETCH_OBJ);

            $region_publicacion = $value -> region_publicacion;
            $tipo_turismo =  $value -> tipo_turismo;
            $tipo_publicacion =  $value -> tipo_publicacion;
            $result = null;
            $sql2 = "SELECT * FROM publicacion 
            WHERE (region_publicacion = '$region_publicacion'
            OR tipo_turismo = '$tipo_turismo' 
            OR tipo_publicacion = '$tipo_publicacion')
            AND estado = 'aprobado'
            AND NOT id_publicacion = '$id_publicacion'
            ORDER BY region_publicacion DESC";

            $result = $db -> query($sql2);

            if($result -> rowCount() > 0){
  
                $publicaciones = $result -> fetchAll(PDO::FETCH_OBJ);
                echo json_encode($publicaciones);
            }else{
                echo json_encode($tipo_publicacion);
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
//
//
//
//
//
//
//Muestra la IMAGEN de la publicacion

$app->get('/publicacion_imagen/{id_publicacion}', function (Request $request, Response $response){
    $id_publicacion = $request->getAttribute('id_publicacion');
    
    $sql = "SELECT * FROM imagen_publicacion 
    WHERE id_publicacion = '$id_publicacion'";
    try {
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> query($sql);
        
        if($result -> rowCount() > 0){
            $publicaciones = $result -> fetchAll (PDO::FETCH_OBJ);
            echo json_encode($publicaciones);

        }else{
            echo json_encode("No hay publicaciones aun!.");
        }
        $result = null;
        $db = null;

    }catch(PDOException $e){
        echo '{"error" : {"texto":'.$e->getMessage().'}';
    }
}); 
//
//
//
//
//
//
//
//POST Agregar nueva publicacion ademas agrega 
//los datos que le corresponden a usuario que publico la 
//publicacion

$app->post('/publicacion_detallada/new', function(Request $request, Response $response){
    
    //estos son los datos que le corresponden a la tabla publicacion sola
    //id_moderador debe ser asignado de manera aleatoria entre los moderadores que esten
    //deberia crearse una funcion aleatoria que lo cree aparte, puede ser en ionic o en la apirest
    
    $nombre_publicacion = $request->getParam('nombre_publicacion');
    $descripcion_publicacion = $request->getParam('descripcion_publicacion');
    $valor_publicacion = $request->getParam('valor_publicacion');
    $region_publicacion = $request->getParam('region_publicacion');
    $tipo_publicacion = $request->getParam('tipo_publicacion');
    $estado = $request->getParam('estado');
    $tipo_turismo = $request->getParam('tipo_turismo');
    $email_contacto = $request->getParam('email_contacto');
    $telefono_contacto = $request->getParam('telefono_contacto');
    $direccion = $request->getParam('direccion');
   
    $comuna_publicacion = $request->getParam('comuna_publicacion'); 
    $calificacion_publicacion = $request->getParam('calificacion_publicacion');
    $visitas = $request->getParam('visitas');  

    //$id_moderador = $request->getParam('id_moderador'); 
    

    //id_usuario
    $id_oferente = $request->getParam('id_oferente');

    //string base64
    $base64 = $request ->getParam('base64');




    $sql= "INSERT INTO publicacion (nombre_publicacion, descripcion_publicacion, valor_publicacion, region_publicacion,
    tipo_publicacion, estado, tipo_turismo, email_contacto, telefono_contacto, direccion, comuna_publicacion,
    calificacion_publicacion, visitas) 
    VALUES (:nombre_publicacion, :descripcion_publicacion, :valor_publicacion, :region_publicacion,
    :tipo_publicacion, :estado, :tipo_turismo, :email_contacto, :telefono_contacto, :direccion, :comuna_publicacion,
    :calificacion_publicacion, :visitas)";


    



    try{
        $db = new db();
        $db = $db -> conectionDB();
        $result = $db -> prepare ($sql);







        $result->bindParam(':nombre_publicacion',$nombre_publicacion);
        $result->bindParam(':descripcion_publicacion',$descripcion_publicacion);
        $result->bindParam(':valor_publicacion',$valor_publicacion);
        $result->bindParam(':region_publicacion',$region_publicacion);
        $result->bindParam(':tipo_publicacion',$tipo_publicacion);
        $result->bindParam(':estado',$estado);
        $result->bindParam(':tipo_turismo',$tipo_turismo);
        $result->bindParam(':email_contacto',$email_contacto);
        $result->bindParam(':telefono_contacto',$telefono_contacto);
        $result->bindParam(':direccion',$direccion);
        $result->bindParam(':comuna_publicacion',$comuna_publicacion);
        $result->bindParam(':calificacion_publicacion',$calificacion_publicacion);
        //$result->bindParam(':id_moderador',$id_moderador);
        $result->bindParam(':visitas',$visitas);
        
        $result->execute();

        $insertId= $db->lastInsertId();
        $result = $db -> prepare ("INSERT INTO publica (id_oferente, id_publicacion) 
        VALUES (:id_oferente, :id_publicacion)");
        $result->bindParam(':id_oferente',$id_oferente);
        $result->bindParam(':id_publicacion',$insertId);
       


        $result->execute();
        

        if(strlen(trim($base64))>0){
        $result = $db -> prepare ("INSERT INTO imagen_publicacion (id_publicacion,base64) VALUES(:id_publicacion,:base64)");
        $result->bindParam('id_publicacion',$insertId);
        $result->bindParam('base64',$base64);

        $result ->execute();
        }
        echo json_encode($insertId);
        $result=null;
        $db=null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}'; 
    }



    
});

