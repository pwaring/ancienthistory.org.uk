<?php

declare(strict_types=1);

namespace AncientHistory\Service;

use AncientHistory\Repository\LatinWorksheetVerbRepository;

class LatinWorksheetVerbService
{
    public function __construct(
        private readonly LatinWorksheetVerbRepository $latinWorksheetVerbRepository
    ) {
    }
}
