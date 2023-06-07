<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606234727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chart DROP created_at');
        $this->addSql('ALTER TABLE task DROP INDEX FK_527EDB25F16DFE2B, ADD UNIQUE INDEX UNIQ_527EDB25F16DFE2B (techn_id)');
        $this->addSql('ALTER TABLE task CHANGE status status TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25537A1329 FOREIGN KEY (message_id) REFERENCES messages (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB25537A1329 ON task (message_id)');
        $this->addSql('ALTER TABLE technician ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chart ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE task DROP INDEX UNIQ_527EDB25F16DFE2B, ADD INDEX FK_527EDB25F16DFE2B (techn_id)');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25537A1329');
        $this->addSql('DROP INDEX UNIQ_527EDB25537A1329 ON task');
        $this->addSql('ALTER TABLE task CHANGE status status TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE technician DROP roles, DROP password');
    }
}
