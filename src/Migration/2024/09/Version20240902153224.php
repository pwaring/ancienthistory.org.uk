<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240902153224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add rogo (I ask) to verbs';
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

        $rogo = [
            'first_person_singular_latin' => 'rogo',
            'first_person_singular_english' => 'I ask',
            'second_person_singular_latin' => 'rogas',
            'second_person_singular_english' => 'you (s.) ask',
            'third_person_singular_latin' => 'rogat',
            'third_person_singular_english' => 'he/she/it asks',
            'first_person_plural_latin' => 'rogamus',
            'first_person_plural_english' => 'we ask',
            'second_person_plural_latin' => 'rogatis',
            'second_person_plural_english' => 'you (pl.) ask',
            'third_person_plural_latin' => 'rogant',
            'third_person_plural_english' => 'they ask',
        ];

        $this->addSql($sql, $rogo);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
