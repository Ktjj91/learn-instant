<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250606133403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE module (id SERIAL NOT NULL, professor_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C2426287D2D84D5 ON module (professor_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN module.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE module_user (module_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(module_id, user_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_37AF9345AFC2B591 ON module_user (module_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_37AF9345A76ED395 ON module_user (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE module ADD CONSTRAINT FK_C2426287D2D84D5 FOREIGN KEY (professor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE module_user ADD CONSTRAINT FK_37AF9345AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE module_user ADD CONSTRAINT FK_37AF9345A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE module DROP CONSTRAINT FK_C2426287D2D84D5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE module_user DROP CONSTRAINT FK_37AF9345AFC2B591
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE module_user DROP CONSTRAINT FK_37AF9345A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE module
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE module_user
        SQL);
    }
}
