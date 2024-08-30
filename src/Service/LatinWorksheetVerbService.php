<?php

declare(strict_types=1);

namespace AncientHistory\Service;

use AncientHistory\Entity\LatinWorksheetVerb;
use AncientHistory\Repository\LatinWorksheetVerbRepository;

class LatinWorksheetVerbService
{
    public function __construct(
        private readonly LatinWorksheetVerbRepository $latinWorksheetVerbRepository
    ) {
    }

    public function find(int $id): ?LatinWorksheetVerb
    {
        return $this->latinWorksheetVerbRepository->find($id);
    }

    /**
     * @return LatinWorksheetVerb[]
     */
    public function findAll(): array
    {
        return $this->latinWorksheetVerbRepository->findBy(
            [],
            [
                'firstPersonSingularLatin' => 'ASC'
            ]
        );
    }

    public function getAllIds(): array
    {
        $ids = [];

        /** @var LatinWorksheetVerb[] $verbs */
        $verbs = $this->latinWorksheetVerbRepository->findAll();

        foreach ($verbs as $verb) {
            $ids[] = $verb->getId();
        }

        return $ids;
    }

    /**
     * Generate a worksheet.
     * 
     * @param LatinWorksheetVerb[] $verbs
     * @return array
     */
    public function generateWorksheet(
        array $verbs,
        int $latinEnglishExercisesNumber,
        int $englishLatinExercisesNumber,
    ): array {
        $worksheet = [];
        $worksheet['latinEnglish'] = [];
        $worksheet['englishLatin'] = [];

        $combinations = [];

        foreach ($verbs as $verb) {
            $combinations[] = [
                'latin' => $verb->getFirstPersonSingularLatin(),
                'english' => $verb->getFirstPersonSingularEnglish(),
            ];

            $combinations[] = [
                'latin' => $verb->getSecondPersonSingularLatin(),
                'english' => $verb->getSecondPersonSingularEnglish(),
            ];

            $combinations[] = [
                'latin' => $verb->getThirdPersonSingularLatin(),
                'english' => $verb->getThirdPersonSingularEnglish(),
            ];

            $combinations[] = [
                'latin' => $verb->getFirstPersonPluralLatin(),
                'english' => $verb->getFirstPersonPluralEnglish(),
            ];

            $combinations[] = [
                'latin' => $verb->getSecondPersonPluralLatin(),
                'english' => $verb->getSecondPersonPluralEnglish(),
            ];

            $combinations[] = [
                'latin' => $verb->getThirdPersonPluralLatin(),
                'english' => $verb->getThirdPersonPluralEnglish(),
            ];
        }

        $latinEnglishCombinations = $combinations;
        $englishLatinCombinations = $combinations;

        shuffle($latinEnglishCombinations);
        shuffle($englishLatinCombinations);

        for (
            $c = 0;
            $c < $latinEnglishExercisesNumber && count($latinEnglishCombinations) > 0;
            $c++
        ) {
            $worksheet['latinEnglish'][] = array_pop($latinEnglishCombinations);
        }

        for (
            $c = 0;
            $c < $englishLatinExercisesNumber && count($englishLatinCombinations) > 0;
            $c++
        ) {
            $worksheet['englishLatin'][] = array_pop($englishLatinCombinations);
        }

        return $worksheet;
    }
}
