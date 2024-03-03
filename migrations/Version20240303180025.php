<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303180025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE quiz_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE quiz (id INT NOT NULL, subcategory_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, difficulty INT DEFAULT NULL, length INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A412FA925DC6FE57 ON quiz (subcategory_id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA925DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE quiz_id_seq CASCADE');
        $this->addSql('ALTER TABLE quiz DROP CONSTRAINT FK_A412FA925DC6FE57');
        $this->addSql('DROP TABLE quiz');
    }
}
