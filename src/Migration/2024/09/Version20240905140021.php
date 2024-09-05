<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240905140021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add do (I give) to verbs';
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

        $do = [
            'first_person_singular_latin' => 'do',
            'first_person_singular_english' => 'I give',
            'second_person_singular_latin' => 'das',
            'second_person_singular_english' => 'you (s.) give',
            'third_person_singular_latin' => 'dat',
            'third_person_singular_english' => 'he/she/it gives',
            'first_person_plural_latin' => 'damus',
            'first_person_plural_english' => 'we give',
            'second_person_plural_latin' => 'datis',
            'second_person_plural_english' => 'you (pl.) give',
            'third_person_plural_latin' => 'dant',
            'third_person_plural_english' => 'they give',
        ];

        $this->addSql($sql, $do);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
