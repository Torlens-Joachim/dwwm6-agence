<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614202807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, property_id INT NOT NULL, appointment_date DATETIME NOT NULL, email VARCHAR(120) NOT NULL, phone VARCHAR(15) NOT NULL, firstname VARCHAR(65) NOT NULL, lastname VARCHAR(65) NOT NULL, INDEX IDX_FE38F8448C03F15C (employee_id), INDEX IDX_FE38F844549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, property_id INT NOT NULL, name VARCHAR(40) NOT NULL, INDEX IDX_16DB4F89549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, title VARCHAR(120) NOT NULL, surface INT NOT NULL, content LONGTEXT DEFAULT NULL, price INT NOT NULL, floor VARCHAR(3) DEFAULT NULL, rooms INT NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(10) NOT NULL, city VARCHAR(65) NOT NULL, type VARCHAR(40) NOT NULL, transaction_type TINYINT(1) NOT NULL, ground_size INT DEFAULT NULL, date_of_construction DATE DEFAULT NULL, sell TINYINT(1) NOT NULL, slug VARCHAR(120) NOT NULL, INDEX IDX_8BF21CDE8C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(65) NOT NULL, lastname VARCHAR(65) NOT NULL, phone VARCHAR(14) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8448C03F15C FOREIGN KEY (employee_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE8C03F15C FOREIGN KEY (employee_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844549213EC');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89549213EC');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8448C03F15C');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE8C03F15C');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE `user`');
    }
}
