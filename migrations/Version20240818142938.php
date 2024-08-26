<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240818142938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item CHANGE service_id service_id INT DEFAULT NULL, CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE item_status_id item_status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE price price DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE item CHANGE service_id service_id INT NOT NULL, CHANGE commande_id commande_id INT NOT NULL, CHANGE item_status_id item_status_id INT NOT NULL');
    }
}
