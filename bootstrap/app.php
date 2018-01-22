<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
    'settings'=> [
        'displayErrorDetails' => true,
    ]
]);

$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__.'/../resources/views', [
        'cache' => __DIR__.'/cache',
    ]);

    // Instantiate and add Slim specific extension
    $view->addExtension(new Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()

    ));

    return $view;
};

require __DIR__ . '/../app/routes.php';