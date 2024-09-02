<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240902104038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add canto (I sing) to verbs';
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

        $canto = [
            'first_person_singular_latin' => 'canto',
            'first_person_singular_english' => 'I sing',
            'second_person_singular_latin' => 'cantas',
            'second_person_singular_english' => 'you (s.) sing',
            'third_person_singular_latin' => 'cantat',
            'third_person_singular_english' => 'he/she/it sings',
            'first_person_plural_latin' => 'cantamus',
            'first_person_plural_english' => 'we sing',
            'second_person_plural_latin' => 'cantatis',
            'second_person_plural_english' => 'you (pl.) sing',
            'third_person_plural_latin' => 'cantant',
            'third_person_plural_english' => 'they sing',
        ];

        $this->addSql($sql, $canto);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
