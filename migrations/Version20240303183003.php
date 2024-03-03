<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303183003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE answer (id INT NOT NULL, question_id INT NOT NULL, answer_text VARCHAR(255) NOT NULL, is_correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE TABLE answer_quiz (answer_id INT NOT NULL, quiz_id INT NOT NULL, PRIMARY KEY(answer_id, quiz_id))');
        $this->addSql('CREATE INDEX IDX_FA391952AA334807 ON answer_quiz (answer_id)');
        $this->addSql('CREATE INDEX IDX_FA391952853CD175 ON answer_quiz (quiz_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, question_text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE question_quiz (question_id INT NOT NULL, quiz_id INT NOT NULL, PRIMARY KEY(question_id, quiz_id))');
        $this->addSql('CREATE INDEX IDX_FAFC177D1E27F6BF ON question_quiz (question_id)');
        $this->addSql('CREATE INDEX IDX_FAFC177D853CD175 ON question_quiz (quiz_id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_quiz ADD CONSTRAINT FK_FA391952AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_quiz ADD CONSTRAINT FK_FA391952853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_quiz ADD CONSTRAINT FK_FAFC177D1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_quiz ADD CONSTRAINT FK_FAFC177D853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE answer_quiz DROP CONSTRAINT FK_FA391952AA334807');
        $this->addSql('ALTER TABLE answer_quiz DROP CONSTRAINT FK_FA391952853CD175');
        $this->addSql('ALTER TABLE question_quiz DROP CONSTRAINT FK_FAFC177D1E27F6BF');
        $this->addSql('ALTER TABLE question_quiz DROP CONSTRAINT FK_FAFC177D853CD175');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE answer_quiz');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_quiz');
    }
}
