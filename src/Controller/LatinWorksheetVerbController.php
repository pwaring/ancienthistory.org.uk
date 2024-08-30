<?php

declare(strict_types=1);

namespace AncientHistory\Controller;

use AncientHistory\Entity\LatinWorksheetVerb;
use AncientHistory\Service\LatinWorksheetVerbService;
use Laminas\Validator\Digits;
use Laminas\Validator\NumberComparison;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class LatinWorksheetVerbController
{
    public function __construct(
        private readonly Twig $view,
        private readonly LatinWorksheetVerbService $latinWorksheetVerbService
    ) {
    }

    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->view->render(
            $response,
            'latin/worksheet/verbs/index.twig.html',
            []
        );
    }

    public function create(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $verbs = $this->latinWorksheetVerbService->findAll();

        return $this->view->render(
            $response,
            'latin/worksheet/verbs/create.twig.html',
            [
                'verbs' => $verbs
            ]
        );
    }

    public function store(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $clean = [];
        $form = $request->getParsedBody();
        $errors = [];
        $verbIds = $this->latinWorksheetVerbService->getAllIds();
        $verbs = $this->latinWorksheetVerbService->findAll();

        $digitsValidator = new Digits();
        $exerciseNumberValidator = new NumberComparison([
            'min' => 0,
            'max' => 60,
        ]);

        if (isset($form['verbs'])) {
            foreach ($form['verbs'] as $id => $val) {
                if (in_array((int) $id, $verbIds, true)) {
                    $clean['verbs'][] = (int) $id;
                } else {
                    $errors['general'] = 'Invalid verb selection';
                }
            }
        } else {
            $errors['verbs'] = 'Please select at least one verb';
        }

        if (isset($form['latin_english_exercises_number'])) {
            if (
                $digitsValidator->isValid($form['latin_english_exercises_number']) &&
                $exerciseNumberValidator->isValid($form['latin_english_exercises_number'])
            ) {
                $clean['latin_english_exercises_number'] = (int) $form['latin_english_exercises_number'];
            } else {
                $errors['latin_english_exercises_number'] = 'Please enter the number of Latin to English exercises (maximum 60, enter 0 if none are required)';
            }
        } else {
            $errors['latin_english_exercises_number'] = 'Please enter the number of Latin to English exercises (maximum 60, enter 0 if none are required)';
        }

        if (isset($form['english_latin_exercises_number'])) {
            if (
                $digitsValidator->isValid($form['english_latin_exercises_number']) &&
                $exerciseNumberValidator->isValid($form['english_latin_exercises_number'])
            ) {
                $clean['english_latin_exercises_number'] = (int) $form['english_latin_exercises_number'];
            } else {
                $errors['english_latin_exercises_number'] = 'Please enter the number of English to Latin exercises (maximum 60, enter 0 if none are required)';
            }
        } else {
            $errors['english_latin_exercises_number'] = 'Please enter the number of English to Latin exercises (maximum 60, enter 0 if none are required)';
        }

        // Interdependent checks
        if (count($errors) === 0) {
            if (count($clean['verbs']) === 0) {
                $errors['verbs'] = 'Please select at least one verb';
            }
        }

        if (count($errors) === 0) {
            // Generate the verb list
            $worksheetVerbs = [];

            foreach ($clean['verbs'] as $verbId) {
                $verb = $this->latinWorksheetVerbService->find($verbId);

                if ($verb instanceof LatinWorksheetVerb) {
                    $worksheetVerbs[] = $verb;
                }
            }

            $worksheet = $this->latinWorksheetVerbService->generateWorksheet(
                $worksheetVerbs,
                $clean['latin_english_exercises_number'],
                $clean['english_latin_exercises_number']
            );

            return $this->view->render(
                $response,
                'latin/worksheet/verbs/store.twig.html',
                [
                    'worksheet' => $worksheet,
                ]
            );
        } else {
            return $this->view->render(
                $response,
                'latin/worksheet/verbs/create.twig.html',
                [
                    'form' => $form,
                    'errors' => $errors,
                    'verbs' => $verbs
                ]
            );
        }
    }
}
