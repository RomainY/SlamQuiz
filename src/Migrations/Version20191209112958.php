<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209112958 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE tbl_category DROP CONSTRAINT fk_517fffec1e27f6bf');
        $this->addSql('DROP INDEX idx_517fffec1e27f6bf');
        $this->addSql('ALTER TABLE tbl_category DROP question_id');
        $this->addSql('DROP INDEX uniq_e1c4af63aa334807');
        $this->addSql('ALTER TABLE tbl_question ADD categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE tbl_question ALTER answer_id SET NOT NULL');
        $this->addSql('ALTER TABLE tbl_question RENAME COLUMN uptated_at TO updated_at');
        $this->addSql('ALTER TABLE tbl_question ADD CONSTRAINT FK_E1C4AF63A21214B7 FOREIGN KEY (categories_id) REFERENCES tbl_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E1C4AF63A21214B7 ON tbl_question (categories_id)');
        $this->addSql('CREATE INDEX IDX_E1C4AF63AA334807 ON tbl_question (answer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tbl_question DROP CONSTRAINT FK_E1C4AF63A21214B7');
        $this->addSql('DROP INDEX IDX_E1C4AF63A21214B7');
        $this->addSql('DROP INDEX IDX_E1C4AF63AA334807');
        $this->addSql('ALTER TABLE tbl_question DROP categories_id');
        $this->addSql('ALTER TABLE tbl_question ALTER answer_id DROP NOT NULL');
        $this->addSql('ALTER TABLE tbl_question RENAME COLUMN updated_at TO uptated_at');
        $this->addSql('CREATE UNIQUE INDEX uniq_e1c4af63aa334807 ON tbl_question (answer_id)');
        $this->addSql('ALTER TABLE tbl_category ADD question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_category ADD CONSTRAINT fk_517fffec1e27f6bf FOREIGN KEY (question_id) REFERENCES tbl_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_517fffec1e27f6bf ON tbl_category (question_id)');
    }
}
