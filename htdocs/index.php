<?php

declare(strict_types=1);

use AncientHistory\Controllers\PageController;
use DI\Container;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Extra\Intl\IntlExtension;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

if ($_ENV['APP_WHOOPS'] === 'on') {
    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
    $whoops->register();
}

date_default_timezone_set($_ENV['APP_DEFAULT_TIMEZONE']);

$container = new Container();
AppFactory::setContainer($container);

// Register all dependencies
$container->set('view', static function () {
    $twig = Twig::create(
        __DIR__ . '/../templates',
        [
            'strict_variables' => true
        ]
    );
    $twig->addExtension(new IntlExtension());

    return $twig;
});

$container->set('database', static function() {
    $connection = [
        'driver' => 'pdo_mysql',
        'user' => $_ENV['APP_DATABASE_USER'],
        'password' => $_ENV['APP_DATABASE_PASSWORD'],
        'dbname' => $_ENV['APP_DATABASE_NAME'],
        'host' => $_ENV['APP_DATABASE_HOST']
    ];

    $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration([]);

    return Doctrine\ORM\EntityManager::create($connection, $config);
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

$app->get('/', PageController::class . ':index')->setName('index');
$app->get('/about/', PageController::class . ':about')->setName('about');
$app->get('/contact/', PageController::class . ':contact')->setName('contact');
$app->get('/groups/', PageController::class . ':groups')->setName('groups.index');
$app->get('/talks/', PageController::class . ':talks')->setName('talks.index');

$app->run();
