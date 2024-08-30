<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240830121840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add amo (I love) to verbs';
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

        $amo = [
            'first_person_singular_latin' => 'amo',
            'first_person_singular_english' => 'I love',
            'second_person_singular_latin' => 'amas',
            'second_person_singular_english' => 'you (s.) love',
            'third_person_singular_latin' => 'amat',
            'third_person_singular_english' => 'he/she/it loves',
            'first_person_plural_latin' => 'amamus',
            'first_person_plural_english' => 'we love',
            'second_person_plural_latin' => 'amatis',
            'second_person_plural_english' => 'you (pl.) love',
            'third_person_plural_latin' => 'amant',
            'third_person_plural_english' => 'they love',
        ];

        $this->addSql($sql, $amo);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
