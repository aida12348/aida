<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329153552 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acces ADD utilisateur_id INT NOT NULL, ADD autorisation_id INT NOT NULL, ADD agir_id INT NOT NULL');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B10FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B1052C5E836 FOREIGN KEY (autorisation_id) REFERENCES autorisation (id)');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B106948C6C4 FOREIGN KEY (agir_id) REFERENCES document (id)');
        $this->addSql('CREATE INDEX IDX_D0F43B10FB88E14F ON acces (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_D0F43B1052C5E836 ON acces (autorisation_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D0F43B106948C6C4 ON acces (agir_id)');
        $this->addSql('ALTER TABLE utilisateur ADD adresse VARCHAR(255) NOT NULL, ADD téléphone VARCHAR(255) NOT NULL, ADD datedenaissance DATETIME NOT NULL, ADD formation VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acces DROP FOREIGN KEY FK_D0F43B10FB88E14F');
        $this->addSql('ALTER TABLE acces DROP FOREIGN KEY FK_D0F43B1052C5E836');
        $this->addSql('ALTER TABLE acces DROP FOREIGN KEY FK_D0F43B106948C6C4');
        $this->addSql('DROP INDEX IDX_D0F43B10FB88E14F ON acces');
        $this->addSql('DROP INDEX IDX_D0F43B1052C5E836 ON acces');
        $this->addSql('DROP INDEX UNIQ_D0F43B106948C6C4 ON acces');
        $this->addSql('ALTER TABLE acces DROP utilisateur_id, DROP autorisation_id, DROP agir_id');
        $this->addSql('ALTER TABLE utilisateur DROP adresse, DROP téléphone, DROP datedenaissance, DROP formation');
    }
}
