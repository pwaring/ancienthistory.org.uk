<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240830144315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add clamo (I shout) to verbs';
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

        $clamo = [
            'first_person_singular_latin' => 'clamo',
            'first_person_singular_english' => 'I shout',
            'second_person_singular_latin' => 'clamas',
            'second_person_singular_english' => 'you (s.) shout',
            'third_person_singular_latin' => 'clamat',
            'third_person_singular_english' => 'he/she/it shouts',
            'first_person_plural_latin' => 'clamamus',
            'first_person_plural_english' => 'we shout',
            'second_person_plural_latin' => 'clamatis',
            'second_person_plural_english' => 'you (pl.) shout',
            'third_person_plural_latin' => 'clamant',
            'third_person_plural_english' => 'they shout',
        ];

        $this->addSql($sql, $clamo);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
