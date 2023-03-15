<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315212915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact ADD departement_id INT NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD firstname VARCHAR(255) NOT NULL, DROP nom, DROP prenom, DROP departement');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638CCF9E01E ON contact (departement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638CCF9E01E');
        $this->addSql('DROP INDEX IDX_4C62E638CCF9E01E ON contact');
        $this->addSql('ALTER TABLE contact ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD departement VARCHAR(255) NOT NULL, DROP departement_id, DROP lastname, DROP firstname');
    }
}
