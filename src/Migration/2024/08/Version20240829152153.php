<?php

declare(strict_types=1);

namespace AncientHistory\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240829152153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create schema for Latin Worksheet Verbs';
    }

    public function up(Schema $schema): void
    {
        $sql = <<<SQL
            CREATE TABLE latin_worksheet_verbs
            (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                first_person_singular_latin VARCHAR(50) NOT NULL,
                first_person_singular_english VARCHAR(50) NOT NULL,
                second_person_singular_latin VARCHAR(50) NOT NULL,
                second_person_singular_english VARCHAR(50) NOT NULL,
                third_person_singular_latin VARCHAR(50) NOT NULL,
                third_person_singular_english VARCHAR(50) NOT NULL,
                first_person_plural_latin VARCHAR(50) NOT NULL,
                first_person_plural_english VARCHAR(50) NOT NULL,
                second_person_plural_latin VARCHAR(50) NOT NULL,
                second_person_plural_english VARCHAR(50) NOT NULL,
                third_person_plural_latin VARCHAR(50) NOT NULL,
                third_person_plural_english VARCHAR(50) NOT NULL,
                PRIMARY KEY (id)
            ) Engine=InnoDB;
        SQL;
        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException('This migration cannot be reversed');
    }
}
