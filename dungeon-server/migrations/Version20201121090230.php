<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201121090230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE route DROP place_in');
        $this->addSql('ALTER TABLE route RENAME INDEX idx_2c420791fea67aa TO IDX_2C42079B98F6510');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE route ADD place_in INT NOT NULL');
        $this->addSql('ALTER TABLE route RENAME INDEX idx_2c42079b98f6510 TO IDX_2C420791FEA67AA');
    }
}
