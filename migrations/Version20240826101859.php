<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240826101859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item CHANGE service_id service_id INT DEFAULT NULL, CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE item_status_id item_status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item RENAME INDEX fk_1f1b251e12469de2 TO IDX_1F1B251E12469DE2');
        $this->addSql('ALTER TABLE service CHANGE price price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE firstname firstname VARCHAR(100) DEFAULT NULL, CHANGE lastname lastname VARCHAR(100) DEFAULT NULL, CHANGE numadrs numadrs SMALLINT DEFAULT NULL, CHANGE adrs adrs VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(50) DEFAULT NULL, CHANGE zipcode zipcode VARCHAR(6) DEFAULT NULL, CHANGE country country VARCHAR(6) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE firstname firstname VARCHAR(100) NOT NULL, CHANGE lastname lastname VARCHAR(100) NOT NULL, CHANGE numadrs numadrs SMALLINT NOT NULL, CHANGE adrs adrs VARCHAR(255) NOT NULL, CHANGE city city VARCHAR(50) NOT NULL, CHANGE zipcode zipcode VARCHAR(6) NOT NULL, CHANGE country country VARCHAR(6) NOT NULL');
        $this->addSql('ALTER TABLE item CHANGE service_id service_id INT NOT NULL, CHANGE commande_id commande_id INT NOT NULL, CHANGE item_status_id item_status_id INT NOT NULL');
        $this->addSql('ALTER TABLE item RENAME INDEX idx_1f1b251e12469de2 TO FK_1F1B251E12469DE2');
    }
}
