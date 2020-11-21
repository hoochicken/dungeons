<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201121084808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE route DROP FOREIGN KEY FK_2C420791FEA67AA');
        $this->addSql('DROP INDEX IDX_2C420791FEA67AA ON route');
        $this->addSql('ALTER TABLE route DROP place_in_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE route ADD place_in_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C420791FEA67AA FOREIGN KEY (place_in_id_id) REFERENCES place (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2C420791FEA67AA ON route (place_in_id_id)');
    }
}
