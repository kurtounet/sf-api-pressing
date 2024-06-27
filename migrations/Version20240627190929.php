<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240627190929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('DROP TABLE service_status');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E33663AF7');
        $this->addSql('DROP INDEX IDX_1F1B251E33663AF7 ON item');
        $this->addSql('ALTER TABLE item CHANGE service_status_id item_status_id INT NOT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E672D164D FOREIGN KEY (item_status_id) REFERENCES item_status (id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E672D164D ON item (item_status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE item_status');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E672D164D');
        $this->addSql('DROP INDEX IDX_1F1B251E672D164D ON item');
        $this->addSql('ALTER TABLE item CHANGE item_status_id service_status_id INT NOT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E33663AF7 FOREIGN KEY (service_status_id) REFERENCES service_status (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1F1B251E33663AF7 ON item (service_status_id)');
    }
}
