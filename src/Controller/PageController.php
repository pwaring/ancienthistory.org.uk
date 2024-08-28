<?php

declare(strict_types=1);

namespace AncientHistory\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class PageController
{
    public function __construct(
        private readonly Twig $view
    ) {
    }

    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->view->render(
            $response,
            'index.twig.html',
            []
        );
    }

    public function about(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->view->render(
            $response,
            'about/index.twig.html',
            []
        );
    }

    public function contact(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->view->render(
            $response,
            'contact/index.twig.html',
            []
        );
    }

    public function groups(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->view->render(
            $response,
            'groups/index.twig.html',
            []
        );
    }

    public function languages(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->view->render(
            $response,
            'languages/index.twig.html',
            []
        );
    }

    public function ma(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->view->render(
            $response,
            'ma/index.twig.html',
            []
        );
    }

    public function quizzes(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->view->render(
            $response,
            'quizzes/index.twig.html',
            []
        );
    }

    public function talks(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->view->render(
            $response,
            'talks/index.twig.html',
            []
        );
    }
}
