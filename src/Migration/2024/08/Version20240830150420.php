<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240830150420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add specto (I watch) to verbs';
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

        $specto = [
            'first_person_singular_latin' => 'specto',
            'first_person_singular_english' => 'I watch',
            'second_person_singular_latin' => 'spectas',
            'second_person_singular_english' => 'you (s.) watch',
            'third_person_singular_latin' => 'spectat',
            'third_person_singular_english' => 'he/she/it watches',
            'first_person_plural_latin' => 'spectamus',
            'first_person_plural_english' => 'we watch',
            'second_person_plural_latin' => 'spectatis',
            'second_person_plural_english' => 'you (pl.) watch',
            'third_person_plural_latin' => 'spectant',
            'third_person_plural_english' => 'they watch',
        ];

        $this->addSql($sql, $specto);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
