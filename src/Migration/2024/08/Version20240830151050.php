<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240830151050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add ambulo (I walk) to verbs';
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

        $ambulo = [
            'first_person_singular_latin' => 'ambulo',
            'first_person_singular_english' => 'I walk',
            'second_person_singular_latin' => 'ambulas',
            'second_person_singular_english' => 'you (s.) walk',
            'third_person_singular_latin' => 'ambulat',
            'third_person_singular_english' => 'he/she/it walks',
            'first_person_plural_latin' => 'ambulamus',
            'first_person_plural_english' => 'we walk',
            'second_person_plural_latin' => 'ambulatis',
            'second_person_plural_english' => 'you (pl.) walk',
            'third_person_plural_latin' => 'ambulant',
            'third_person_plural_english' => 'they walk',
        ];

        $this->addSql($sql, $ambulo);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
