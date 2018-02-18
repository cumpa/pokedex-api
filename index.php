<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';
require_once 'config.php';

$app = new \Slim\App($config);
$db = new DB($app->getContainer('config')->get('db'));

$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "users" => [
        "root" => "t00r",
    ],
    "passtrough" => '/new/user',
    "authenticator" => new Authenticator(),
]));
$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "path" => '/admin',
    "users" => [
        "root" => "t00r",
    ],
    "authenticator" => new AuthenticatorAdmin(),
]));


$app->get('/', function (Request $request, Response $response, array $args){
    $message = 'Welcome';
    return $response->getBody()->write($message);
});
$app->get('/image/{image}', function (Request $request, Response $response, array $args){   //getImage
    $image = file_get_contents("./images/" . $args['image']);
    $response->getBody()->write($image);
    return $response->withHeader('Content-Type', FILEINFO_MIME_TYPE);
});

$app->delete('/delete/pokemon/{poke_ownership_id}', function (Request $request, Response $response, array $args) {

});
$app->delete('/admin/delete/user/{user_id}', function (Request $request, Response $response, array $args) {

});
$app->delete('/admin/delete/pokemon/{evl_lvl_id}', function (Request $request, Response $response, array $args) {

});

//$app->put();


$app->run();
 ?>
