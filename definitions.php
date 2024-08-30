<?php

declare(strict_types=1);

use AncientHistory\Entity\LatinWorksheetVerb;
use AncientHistory\Repository\LatinWorksheetVerbRepository;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;
use Twig\Extra\Intl\IntlExtension;

$definitions = [];

$definitions[Twig::class] = function () {
    $twig = Twig::create(
        __DIR__ . '/templates',
        [
            'strict_variables' => true
        ]
    );

    $twig->addExtension(new IntlExtension());

    return $twig;
};

$definitions[EntityManager::class] = function () {
    $config = ORMSetup::createAttributeMetadataConfiguration(
        [
            __DIR__ . '/src/Entity/',
        ],
        $_ENV['APP_DOCTRINE_DEV_MODE'] === 'on',
        $_ENV['APP_DOCTRINE_PROXY_DIR']
    );

    $connection = DriverManager::getConnection(
        [
            'driver' => 'pdo_mysql',
            'user' => $_ENV['APP_DATABASE_USER'],
            'password' => $_ENV['APP_DATABASE_PASSWORD'],
            'dbname' => $_ENV['APP_DATABASE_NAME'],
            'host' => $_ENV['APP_DATABASE_HOST']
        ],
        $config
    );

    return new EntityManager($connection, $config);
};

$definitions[LatinWorksheetVerbRepository::class] = function (ContainerInterface $container): LatinWorksheetVerbRepository {
    /** @var EntityManager $entityManager */
    $entityManager = $container->get(EntityManager::class);
    return $entityManager->getRepository(LatinWorksheetVerb::class);
};

return $definitions;
