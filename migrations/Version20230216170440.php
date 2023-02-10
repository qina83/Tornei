<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216170440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partite_giocatori_attivi (username VARCHAR(255) NOT NULL, nome VARCHAR(255) NOT NULL, cognome VARCHAR(255) NOT NULL, PRIMARY KEY(username))');
        $this->addSql('CREATE TABLE partite_tornei_attivi (id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN partite_tornei_attivi.id IS \'(DC2Type:uuid)\'');
        $this->addSql('DROP TABLE giocatore_attivo_entity');
        $this->addSql('DROP TABLE torneo_attivo_entity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE giocatore_attivo_entity (username VARCHAR(255) NOT NULL, nome VARCHAR(255) NOT NULL, cognome VARCHAR(255) NOT NULL, PRIMARY KEY(username))');
        $this->addSql('CREATE TABLE torneo_attivo_entity (id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN torneo_attivo_entity.id IS \'(DC2Type:uuid)\'');
        $this->addSql('DROP TABLE partite_giocatori_attivi');
        $this->addSql('DROP TABLE partite_tornei_attivi');
    }
}
