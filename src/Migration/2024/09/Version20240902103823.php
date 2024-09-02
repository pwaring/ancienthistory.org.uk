<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240902103823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add video (I see) to verbs';
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

        $video = [
            'first_person_singular_latin' => 'video',
            'first_person_singular_english' => 'I see',
            'second_person_singular_latin' => 'vides',
            'second_person_singular_english' => 'you (s.) see',
            'third_person_singular_latin' => 'videt',
            'third_person_singular_english' => 'he/she/it sees',
            'first_person_plural_latin' => 'videmus',
            'first_person_plural_english' => 'we see',
            'second_person_plural_latin' => 'videtis',
            'second_person_plural_english' => 'you (pl.) see',
            'third_person_plural_latin' => 'vident',
            'third_person_plural_english' => 'they see',
        ];

        $this->addSql($sql, $video);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
