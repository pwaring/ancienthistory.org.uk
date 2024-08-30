<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240830145446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add sum (I am) to verbs';
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

        $sum = [
            'first_person_singular_latin' => 'sum',
            'first_person_singular_english' => 'I am',
            'second_person_singular_latin' => 'es',
            'second_person_singular_english' => 'you (s.) are',
            'third_person_singular_latin' => 'est',
            'third_person_singular_english' => 'he/she/it is',
            'first_person_plural_latin' => 'sumus',
            'first_person_plural_english' => 'we are',
            'second_person_plural_latin' => 'estis',
            'second_person_plural_english' => 'you (pl.) are',
            'third_person_plural_latin' => 'sunt',
            'third_person_plural_english' => 'they are',
        ];

        $this->addSql($sql, $sum);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
