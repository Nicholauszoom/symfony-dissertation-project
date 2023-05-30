<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525180118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59FA76ED395');
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59F38C751C4');
        $this->addSql('DROP TABLE user_roles');
        $this->addSql('ALTER TABLE roles ADD roles_id INT NOT NULL, DROP status');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC738C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id)');
        $this->addSql('CREATE INDEX IDX_B63E2EC738C751C4 ON roles (roles_id)');
        $this->addSql('ALTER TABLE task DROP INDEX FK_527EDB25F16DFE2B, ADD UNIQUE INDEX UNIQ_527EDB25F16DFE2B (techn_id)');
        $this->addSql('ALTER TABLE task CHANGE status status TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25537A1329 FOREIGN KEY (message_id) REFERENCES messages (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB25537A1329 ON task (message_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_roles (user_id INT NOT NULL, roles_id INT NOT NULL, INDEX IDX_54FCD59FA76ED395 (user_id), INDEX IDX_54FCD59F38C751C4 (roles_id), PRIMARY KEY(user_id, roles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59F38C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC738C751C4');
        $this->addSql('DROP INDEX IDX_B63E2EC738C751C4 ON roles');
        $this->addSql('ALTER TABLE roles ADD status TINYINT(1) NOT NULL, DROP roles_id');
        $this->addSql('ALTER TABLE task DROP INDEX UNIQ_527EDB25F16DFE2B, ADD INDEX FK_527EDB25F16DFE2B (techn_id)');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25537A1329');
        $this->addSql('DROP INDEX UNIQ_527EDB25537A1329 ON task');
        $this->addSql('ALTER TABLE task CHANGE status status TINYINT(1) NOT NULL');
    }
}
