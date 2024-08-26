<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240818140909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE lastname lastname VARCHAR(100) DEFAULT NULL, CHANGE adrs adrs VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(50) DEFAULT NULL, CHANGE zipcode zipcode VARCHAR(6) DEFAULT NULL, CHANGE country country VARCHAR(6) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE lastname lastname VARCHAR(100) NOT NULL, CHANGE adrs adrs VARCHAR(255) NOT NULL, CHANGE city city VARCHAR(50) NOT NULL, CHANGE zipcode zipcode VARCHAR(6) NOT NULL, CHANGE country country VARCHAR(6) NOT NULL');
    }
}
