<?php

declare(strict_types=1);

use AncientHistory\Controller\PageController;

/** @var \Slim\App $app */

$app->get('/', PageController::class . ':index')->setName('index');
$app->get('/about/', PageController::class . ':about')->setName('about');
$app->get('/contact/', PageController::class . ':contact')->setName('contact');
$app->get('/groups/', PageController::class . ':groups')->setName('groups.index');
$app->get('/languages/', PageController::class . ':languages')->setName('languages.index');
$app->get('/ma/', PageController::class . ':ma')->setName('ma.index');
$app->get('/quizzes/', PageController::class . ':quizzes')->setName('quizzes.index');
$app->get('/talks/', PageController::class . ':talks')->setName('talks.index');
