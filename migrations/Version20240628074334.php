<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240628074334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service_category (service_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_FF3A42FCED5CA9E6 (service_id), INDEX IDX_FF3A42FC12469DE2 (category_id), PRIMARY KEY(service_id, category_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE service_category ADD CONSTRAINT FK_FF3A42FCED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_category ADD CONSTRAINT FK_FF3A42FC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E7294869C');
        $this->addSql('DROP INDEX IDX_1F1B251E7294869C ON item');
        $this->addSql('ALTER TABLE item DROP article_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_category DROP FOREIGN KEY FK_FF3A42FCED5CA9E6');
        $this->addSql('ALTER TABLE service_category DROP FOREIGN KEY FK_FF3A42FC12469DE2');
        $this->addSql('DROP TABLE service_category');
        $this->addSql('ALTER TABLE item ADD article_id INT NOT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1F1B251E7294869C ON item (article_id)');
    }
}
