<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240626190323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, urlimage VARCHAR(255) DEFAULT NULL, category_id INT NOT NULL, INDEX IDX_23A0E6612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, parent_id INT DEFAULT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, ref VARCHAR(10) NOT NULL, filing_date DATE NOT NULL, return_date DATE NOT NULL, payment_date DATE NOT NULL, user_id INT DEFAULT NULL, means_payment_id INT NOT NULL, INDEX IDX_6EEAA67DA76ED395 (user_id), INDEX IDX_6EEAA67D17157679 (means_payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, detail_item LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, article_id INT NOT NULL, service_id INT NOT NULL, material_id INT NOT NULL, user_id INT NOT NULL, item_etat_id INT NOT NULL, commande_id INT NOT NULL, service_status_id INT NOT NULL, INDEX IDX_1F1B251E7294869C (article_id), INDEX IDX_1F1B251EED5CA9E6 (service_id), INDEX IDX_1F1B251EE308AC6F (material_id), INDEX IDX_1F1B251EA76ED395 (user_id), INDEX IDX_1F1B251E603A0AB (item_etat_id), INDEX IDX_1F1B251E82EA2E54 (commande_id), INDEX IDX_1F1B251E33663AF7 (service_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE item_etat (id INT AUTO_INCREMENT NOT NULL, state VARCHAR(100) NOT NULL, coeff DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, coeff DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE material_service (material_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_5007417DE308AC6F (material_id), INDEX IDX_5007417DED5CA9E6 (service_id), PRIMARY KEY(material_id, service_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE meansofpayment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE service_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, mobilephone VARCHAR(13) DEFAULT NULL, phone VARCHAR(13) DEFAULT NULL, dateborn DATE DEFAULT NULL, numadrs SMALLINT NOT NULL, adrs VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, zipcode VARCHAR(6) NOT NULL, country VARCHAR(6) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D17157679 FOREIGN KEY (means_payment_id) REFERENCES meansofpayment (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EE308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E603A0AB FOREIGN KEY (item_etat_id) REFERENCES item_etat (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E33663AF7 FOREIGN KEY (service_status_id) REFERENCES service_status (id)');
        $this->addSql('ALTER TABLE material_service ADD CONSTRAINT FK_5007417DE308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE material_service ADD CONSTRAINT FK_5007417DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D17157679');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E7294869C');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EED5CA9E6');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EE308AC6F');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EA76ED395');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E603A0AB');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E82EA2E54');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E33663AF7');
        $this->addSql('ALTER TABLE material_service DROP FOREIGN KEY FK_5007417DE308AC6F');
        $this->addSql('ALTER TABLE material_service DROP FOREIGN KEY FK_5007417DED5CA9E6');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_etat');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE material_service');
        $this->addSql('DROP TABLE meansofpayment');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_status');
        $this->addSql('DROP TABLE user');
    }
}
