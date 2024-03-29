<?php

declare(strict_types=1);

use AncientHistory\Controllers\PageController;
use DI\Container;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Extra\Intl\IntlExtension;
use Whoops\Handler\PrettyPageHandler;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('WHOOPS_ENABLED', isset($_ENV['APP_WHOOPS']) && $_ENV['APP_WHOOPS'] === 'on');

if (WHOOPS_ENABLED) {
    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new PrettyPageHandler());
    $whoops->register();
}

date_default_timezone_set($_ENV['APP_DEFAULT_TIMEZONE']);

$container = new Container();
AppFactory::setContainer($container);

// Register all dependencies
$container->set('view', static function () {
    $twig = Twig::create(
        __DIR__ . '/templates',
        [
            'strict_variables' => true
        ]
    );
    $twig->addExtension(new IntlExtension());

    return $twig;
});

// Register all controllers
$container->set(PageController::class, function (ContainerInterface $container) {
    $view = $container->get('view');

    return new PageController($view);
});

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
$app->add(TwigMiddleware::createFromContainer($app));

if (!WHOOPS_ENABLED) {
    $errorMiddleware = new ErrorMiddleware(
        $app->getCallableResolver(),
        $app->getResponseFactory(),
        false,
        true,
        true
    );

    $app->add($errorMiddleware);
}
