<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240830152005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add habeo (I have) to verbs';
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

        $habeo = [
            'first_person_singular_latin' => 'habeo',
            'first_person_singular_english' => 'I have',
            'second_person_singular_latin' => 'habes',
            'second_person_singular_english' => 'you (s.) have',
            'third_person_singular_latin' => 'habet',
            'third_person_singular_english' => 'he/she/it has',
            'first_person_plural_latin' => 'habemus',
            'first_person_plural_english' => 'we have',
            'second_person_plural_latin' => 'habetis',
            'second_person_plural_english' => 'you (pl.) have',
            'third_person_plural_latin' => 'habent',
            'third_person_plural_english' => 'they have',
        ];

        $this->addSql($sql, $habeo);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
