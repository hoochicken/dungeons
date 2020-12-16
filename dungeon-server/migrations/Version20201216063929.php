<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216063929 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE item2hero');
        $this->addSql('ALTER TABLE item CHANGE decription description VARCHAR(1023) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item2hero (item_id INT NOT NULL, hero_id INT NOT NULL, attributes VARCHAR(1023) CHARACTER SET utf8mb4 DEFAULT \'{}\' NOT NULL COLLATE `utf8mb4_0900_ai_ci`, state TINYINT(1) DEFAULT \'1\' NOT NULL, created DATETIME DEFAULT NULL, created_user INT NOT NULL, updated DATETIME DEFAULT NULL, updated_user INT DEFAULT NULL, deleted DATETIME DEFAULT NULL, deleted_user INT DEFAULT NULL, PRIMARY KEY(item_id, hero_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE item CHANGE description decription VARCHAR(1023) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`');
    }
}
