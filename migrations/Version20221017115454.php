<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221017115454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF82EA2E54');
        $this->addSql('DROP INDEX IDX_C509E4FF82EA2E54 ON chambre');
        $this->addSql('ALTER TABLE chambre DROP commande_id');
        $this->addSql('ALTER TABLE commande ADD chambre_id INT NOT NULL, CHANGE telephone telephone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D9B177F54 ON commande (chambre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre ADD commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_C509E4FF82EA2E54 ON chambre (commande_id)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D9B177F54');
        $this->addSql('DROP INDEX IDX_6EEAA67D9B177F54 ON commande');
        $this->addSql('ALTER TABLE commande DROP chambre_id, CHANGE telephone telephone INT NOT NULL');
    }
}
