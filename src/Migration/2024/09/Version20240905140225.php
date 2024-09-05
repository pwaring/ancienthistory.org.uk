<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240905140225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add habito (I live) to verbs';
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

        $habito = [
            'first_person_singular_latin' => 'habito',
            'first_person_singular_english' => 'I live',
            'second_person_singular_latin' => 'habitas',
            'second_person_singular_english' => 'you (s.) live',
            'third_person_singular_latin' => 'habitat',
            'third_person_singular_english' => 'he/she/it lives',
            'first_person_plural_latin' => 'habitamus',
            'first_person_plural_english' => 'we live',
            'second_person_plural_latin' => 'habitatis',
            'second_person_plural_english' => 'you (pl.) live',
            'third_person_plural_latin' => 'habitant',
            'third_person_plural_english' => 'they live',
        ];

        $this->addSql($sql, $habito);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
