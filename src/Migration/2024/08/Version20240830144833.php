<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240830144833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add paro (I prepare) to verbs';
    }

    public function up(Schema $schema): void
    {
        $sql = <<<SQL
            INSERT INTO latin_worksheet_verbs (
                first_person_singular_latin,
                first_person_singular_english,
                second_person_singular_latin,
                second_person_singular_english,
                third_person_singular_latin,
                third_person_singular_english,
                first_person_plural_latin,
                first_person_plural_english,
                second_person_plural_latin,
                second_person_plural_english,
                third_person_plural_latin,
                third_person_plural_english
            ) VALUES (
                :first_person_singular_latin,
                :first_person_singular_english,
                :second_person_singular_latin,
                :second_person_singular_english,
                :third_person_singular_latin,
                :third_person_singular_english,
                :first_person_plural_latin,
                :first_person_plural_english,
                :second_person_plural_latin,
                :second_person_plural_english,
                :third_person_plural_latin,
                :third_person_plural_english
            )
        SQL;

        $paro = [
            'first_person_singular_latin' => 'paro',
            'first_person_singular_english' => 'I prepare',
            'second_person_singular_latin' => 'paras',
            'second_person_singular_english' => 'you (s.) prepare',
            'third_person_singular_latin' => 'parat',
            'third_person_singular_english' => 'he/she/it prepares',
            'first_person_plural_latin' => 'paramus',
            'first_person_plural_english' => 'we prepare',
            'second_person_plural_latin' => 'paratis',
            'second_person_plural_english' => 'you (pl.) prepare',
            'third_person_plural_latin' => 'parant',
            'third_person_plural_english' => 'they prepare',
        ];

        $this->addSql($sql, $paro);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
