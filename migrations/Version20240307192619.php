<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307192619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD img VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE subcategory ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE subcategory ADD img VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE subcategory DROP description');
        $this->addSql('ALTER TABLE subcategory DROP img');
        $this->addSql('ALTER TABLE category DROP description');
        $this->addSql('ALTER TABLE category DROP img');
    }
}
