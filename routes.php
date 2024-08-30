<?php

declare(strict_types=1);

use AncientHistory\Controller\LatinWorksheetVerbController;
use AncientHistory\Controller\PageController;
use Slim\Routing\RouteCollectorProxy;

/** @var \Slim\App $app */

$app->get('/', PageController::class . ':index')->setName('index');
$app->get('/about/', PageController::class . ':about')->setName('about');
$app->get('/contact/', PageController::class . ':contact')->setName('contact');
$app->get('/groups/', PageController::class . ':groups')->setName('groups.index');
$app->get('/languages/', PageController::class . ':languages')->setName('languages.index');
$app->get('/ma/', PageController::class . ':ma')->setName('ma.index');
$app->get('/quizzes/', PageController::class . ':quizzes')->setName('quizzes.index');
$app->get('/talks/', PageController::class . ':talks')->setName('talks.index');

$app->group(
    '/languages/latin/worksheet/verbs',
    function (RouteCollectorProxy $latinWorksheetVerbs) {
        $latinWorksheetVerbs->get(
            '',
            LatinWorksheetVerbController::class . ':index'
        )->setName('latin.worksheet.verbs.index');

        $latinWorksheetVerbs->get(
            '/create',
            LatinWorksheetVerbController::class . ':create'
        )->setName('latin.worksheet.verbs.create');

        $latinWorksheetVerbs->post(
            '/store',
            LatinWorksheetVerbController::class . ':store'
        )->setName('latin.worksheet.verbs.store');
    }
);
