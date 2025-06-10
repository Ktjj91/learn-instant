<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250606142456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE folder (id SERIAL NOT NULL, module_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_ECA209CDAFC2B591 ON folder (module_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_ECA209CD727ACA70 ON folder (parent_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN folder.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE folder ADD CONSTRAINT FK_ECA209CDAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE folder ADD CONSTRAINT FK_ECA209CD727ACA70 FOREIGN KEY (parent_id) REFERENCES folder (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file ADD folder_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file ADD CONSTRAINT FK_8C9F3610162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8C9F3610162CB942 ON file (folder_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file DROP CONSTRAINT FK_8C9F3610162CB942
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE folder DROP CONSTRAINT FK_ECA209CDAFC2B591
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE folder DROP CONSTRAINT FK_ECA209CD727ACA70
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE folder
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8C9F3610162CB942
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file DROP folder_id
        SQL);
    }
}
