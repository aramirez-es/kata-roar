<?php

/**
 * Single entry point to the application.
 */

use Symfony\Component\HttpFoundation\JsonResponse as Response;

require_once realpath( __DIR__ . '/../' ) . '/vendor/autoload.php';

$app = new Silex\Application();
$user_domain_factory = new Core\Roar\Factory();
$mongo_connection = new Mongo(); // Don't blame me by using Mongo instead MongoClient.
$user_service = $user_domain_factory->userServicePersistent($mongo_connection->selectDB('roar'));

$app->post('/users', function() use($app, $user_service){

    $response_code = 204;
    $response_message = null;

    try {
        $username = $app['request']->getContent();
        $user_service->register($app->escape($username));
    } catch (InvalidArgumentException $e) {
        $response_code = 409;
        $response_message = 'This user already exists';
    }

    return new Response($response_message, $response_code);
});

$app->post('/users/{username}/followings', function($username) use($app, $user_service){

    $following = $app['request']->getContent();
    $user_service->follow($app->escape($username), $app->escape($following));

    return new Response(null, 204);
});

$app->get('/users/{username}/followings', function($username) use($app, $user_service){

    $followers = $user_service->getFollowers($app->escape($username));

    return new Response($followers);
});

$app->run();
