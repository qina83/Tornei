<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216171232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gestione_tornei_tornei_state (id UUID NOT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'now()\' NOT NULL, stato_attivazione VARCHAR(255) DEFAULT \'disattivato\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN gestione_tornei_tornei_state.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE gestione_utenti_giocatori_state (username VARCHAR(255) NOT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, stato_attivazione_account BOOLEAN NOT NULL, nome VARCHAR(255) NOT NULL, cognome VARCHAR(255) NOT NULL, PRIMARY KEY(username))');
        $this->addSql('DROP TABLE torneo_state');
        $this->addSql('DROP TABLE giocatore_state_entity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE torneo_state (id UUID NOT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'now()\' NOT NULL, stato_attivazione VARCHAR(255) DEFAULT \'disattivato\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN torneo_state.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE giocatore_state_entity (username VARCHAR(255) NOT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, stato_attivazione_account BOOLEAN NOT NULL, nome VARCHAR(255) NOT NULL, cognome VARCHAR(255) NOT NULL, PRIMARY KEY(username))');
        $this->addSql('DROP TABLE gestione_tornei_tornei_state');
        $this->addSql('DROP TABLE gestione_utenti_giocatori_state');
    }
}
