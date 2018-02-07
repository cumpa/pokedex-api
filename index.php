<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'config.php';


$app = new \Slim\App($config);


$db = new DB($app->getContainer('config')->get('db'));

$app->get('/', function (Request $request, Response $response, array $args){
    $message = 'Welcome';
    return $response->getBody()->write($message);
});

$app->get('/{message}/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $message = $args['message'];
    $arr = ['dobre ja' => "$message, $name"];
    $response->getBody()->write(json_encode($arr));
    return $response;
});
$app->run();
 ?>
