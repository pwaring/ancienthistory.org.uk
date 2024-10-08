<?php

declare(strict_types=1);

use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required([
    'APP_DEFAULT_TIMEZONE',
    'APP_DATABASE_USER',
    'APP_DATABASE_PASSWORD',
    'APP_DATABASE_NAME',
    'APP_DATABASE_HOST',
    'APP_DOCTRINE_DEV_MODE',
    'APP_DOCTRINE_PROXY_DIR',
]);

if (isset($_ENV['APP_WHOOPS']) && $_ENV['APP_WHOOPS'] === 'on') {
    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
    $whoops->register();
}

date_default_timezone_set($_ENV['APP_DEFAULT_TIMEZONE']);

$definitions = require_once __DIR__ . '/definitions.php';

$builder = new ContainerBuilder();
$builder->addDefinitions($definitions);
$container = $builder->build();
$app = Bridge::create($container);

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
$app->add(TwigMiddleware::createFromContainer($app, Twig::class));

if (!(isset($_ENV['APP_WHOOPS']) && $_ENV['APP_WHOOPS'] === 'on')) {
    $errorMiddleware = new ErrorMiddleware(
        $app->getCallableResolver(),
        $app->getResponseFactory(),
        false,
        true,
        true
    );

    $app->add($errorMiddleware);
}
