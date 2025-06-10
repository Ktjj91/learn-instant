<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250606135304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE file (id SERIAL NOT NULL, module_id INT DEFAULT NULL, uploader_id INT DEFAULT NULL, original_name VARCHAR(255) NOT NULL, file_path VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, size INT NOT NULL, uploadted_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8C9F3610AFC2B591 ON file (module_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8C9F361016678C77 ON file (uploader_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN file.uploadted_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file ADD CONSTRAINT FK_8C9F3610AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file ADD CONSTRAINT FK_8C9F361016678C77 FOREIGN KEY (uploader_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file DROP CONSTRAINT FK_8C9F3610AFC2B591
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file DROP CONSTRAINT FK_8C9F361016678C77
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE file
        SQL);
    }
}
