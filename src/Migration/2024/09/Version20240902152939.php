<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240902152939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add pugno (I fight) to verbs';
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

        $pugno = [
            'first_person_singular_latin' => 'pugno',
            'first_person_singular_english' => 'I fight',
            'second_person_singular_latin' => 'pugnas',
            'second_person_singular_english' => 'you (s.) fight',
            'third_person_singular_latin' => 'pugnat',
            'third_person_singular_english' => 'he/she/it fights',
            'first_person_plural_latin' => 'pugnamus',
            'first_person_plural_english' => 'we fight',
            'second_person_plural_latin' => 'pugnatis',
            'second_person_plural_english' => 'you (pl.) fight',
            'third_person_plural_latin' => 'pugnant',
            'third_person_plural_english' => 'they fight',
        ];

        $this->addSql($sql, $pugno);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
