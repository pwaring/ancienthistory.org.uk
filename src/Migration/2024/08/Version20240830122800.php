<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240830122800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add laboro (I work) to verbs';
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

        $laboro = [
            'first_person_singular_latin' => 'laboro',
            'first_person_singular_english' => 'I work',
            'second_person_singular_latin' => 'laboras',
            'second_person_singular_english' => 'you (s.) work',
            'third_person_singular_latin' => 'laborat',
            'third_person_singular_english' => 'he/she/it works',
            'first_person_plural_latin' => 'laboramus',
            'first_person_plural_english' => 'we work',
            'second_person_plural_latin' => 'laboratis',
            'second_person_plural_english' => 'you (pl.) work',
            'third_person_plural_latin' => 'laborant',
            'third_person_plural_english' => 'they work',
        ];

        $this->addSql($sql, $laboro);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
