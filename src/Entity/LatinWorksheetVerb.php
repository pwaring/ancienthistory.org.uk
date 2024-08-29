<?php

declare(strict_types=1);

namespace AncientHistory\Entity;

use AncientHistory\Repository\LatinWorksheetVerbRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(
    repositoryClass: LatinWorksheetVerbRepository::class
)]
#[ORM\Table(
    name: 'latin_worksheet_verbs'
)]
class LatinWorksheetVerb
{
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(
        name: 'id',
        type: 'integer'
    )]
    protected int $id;

    #[ORM\Column(
        name: 'first_person_singular_latin',
        type: 'string',
        nullable: false
    )]
    protected string $firstPersonSingularLatin;

    #[ORM\Column(
        name: 'first_person_singular_english',
        type: 'string',
        nullable: false
    )]
    protected string $firstPersonSingularEnglish;

    #[ORM\Column(
        name: 'second_person_singular_latin',
        type: 'string',
        nullable: false
    )]
    protected string $secondPersonSingularLatin;

    #[ORM\Column(
        name: 'second_person_singular_english',
        type: 'string',
        nullable: false
    )]
    protected string $secondPersonSingularEnglish;

    #[ORM\Column(
        name: 'third_person_singular_latin',
        type: 'string',
        nullable: false
    )]
    protected string $thirdPersonSingularLatin;

    #[ORM\Column(
        name: 'third_person_singular_english',
        type: 'string',
        nullable: false
    )]
    protected string $thirdPersonSingularEnglish;

    #[ORM\Column(
        name: 'first_person_plural_latin',
        type: 'string',
        nullable: false
    )]
    protected string $firstPersonPluralLatin;

    #[ORM\Column(
        name: 'first_person_plural_english',
        type: 'string',
        nullable: false
    )]
    protected string $firstPersonPluralEnglish;

    #[ORM\Column(
        name: 'second_person_plural_latin',
        type: 'string',
        nullable: false
    )]
    protected string $secondPersonPluralLatin;

    #[ORM\Column(
        name: 'second_person_plural_english',
        type: 'string',
        nullable: false
    )]
    protected string $secondPersonPluralEnglish;

    #[ORM\Column(
        name: 'third_person_plural_latin',
        type: 'string',
        nullable: false
    )]
    protected string $thirdPersonPluralLatin;

    #[ORM\Column(
        name: 'third_person_plural_english',
        type: 'string',
        nullable: false
    )]
    protected string $thirdPersonPluralEnglish;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstPersonSingularLatin(): string
    {
        return $this->firstPersonSingularLatin;
    }

    public function getFirstPersonSingularEnglish(): string
    {
        return $this->firstPersonSingularEnglish;
    }

    public function getSecondPersonSingularLatin(): string
    {
        return $this->secondPersonSingularLatin;
    }

    public function getSecondPersonSingularEnglish(): string
    {
        return $this->secondPersonSingularEnglish;
    }

    public function getThirdPersonSingularLatin(): string
    {
        return $this->thirdPersonSingularLatin;
    }

    public function getThirdPersonSingularEnglish(): string
    {
        return $this->thirdPersonSingularEnglish;
    }

    public function getFirstPersonPluralLatin(): string
    {
        return $this->firstPersonPluralLatin;
    }

    public function getFirstPersonPluralEnglish(): string
    {
        return $this->firstPersonPluralEnglish;
    }

    public function getSecondPersonPluralLatin(): string
    {
        return $this->secondPersonPluralLatin;
    }

    public function getSecondPersonPluralEnglish(): string
    {
        return $this->secondPersonPluralEnglish;
    }

    public function getThirdPersonPluralLatin(): string
    {
        return $this->thirdPersonPluralLatin;
    }

    public function getThirdPersonPluralEnglish(): string
    {
        return $this->thirdPersonPluralEnglish;
    }
}
