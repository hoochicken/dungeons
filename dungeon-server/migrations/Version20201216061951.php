<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216061951 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE place_item (place_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_D5AE55F2DA6A219 (place_id), INDEX IDX_D5AE55F2126F525E (item_id), PRIMARY KEY(place_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_item (hero_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_9FF0475845B0BCD (hero_id), INDEX IDX_9FF04758126F525E (item_id), PRIMARY KEY(hero_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE place_item ADD CONSTRAINT FK_D5AE55F2DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_item ADD CONSTRAINT FK_D5AE55F2126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_item ADD CONSTRAINT FK_9FF0475845B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_item ADD CONSTRAINT FK_9FF04758126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hero_item');
        $this->addSql('DROP TABLE place_item');
    }
}
