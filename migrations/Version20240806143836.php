<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240806143836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE utilisateur');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, imageUrl VARCHAR(250) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, contenu TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, titre VARCHAR(250) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, auteur VARCHAR(250) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, datePublication DATETIME NOT NULL, UNIQUE INDEX annonce_id_uindex (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(250) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, nom VARCHAR(250) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, prenom VARCHAR(250) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, password VARCHAR(250) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, UNIQUE INDEX utilisateur_id_uindex (id), UNIQUE INDEX utilisateur_login_uindex (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }
}
