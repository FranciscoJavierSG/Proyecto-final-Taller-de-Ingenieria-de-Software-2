<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, Accept");
error_reporting(-1);
ini_set('display_errors', 1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require  '../vendor/autoload.php';
require '../src/config/db.php';


$app = new \Slim\App;




//ruta de cosas



require '../src/rutas/moderador.php';
require '../src/rutas/oferente.php';
require '../src/rutas/publica.php';
require '../src/rutas/publicacion.php';
require '../src/rutas/usuario.php';
require '../src/rutas/login.php';
require '../src/rutas/review.php';
require '../src/rutas/comentario.php';
require '../src/rutas/guardar.php';
require '../src/rutas/etiqueta.php';
require '../src/rutas/historial.php';

$app->run();

