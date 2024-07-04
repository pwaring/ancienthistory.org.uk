<?php

declare(strict_types=1);

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

return $definitions;
