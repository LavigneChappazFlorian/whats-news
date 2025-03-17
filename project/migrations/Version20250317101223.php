<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317101223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule ADD teacher VARCHAR(255) NOT NULL, ADD morning_subject VARCHAR(255) NOT NULL, ADD afternoon_subject VARCHAR(255) NOT NULL, DROP morning, DROP afternoon');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule ADD morning VARCHAR(255) NOT NULL, ADD afternoon VARCHAR(255) NOT NULL, DROP teacher, DROP morning_subject, DROP afternoon_subject');
    }
}
