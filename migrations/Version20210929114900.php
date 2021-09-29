<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210929114900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, employee_id INTEGER NOT NULL, property_id INTEGER NOT NULL, appointment_date DATETIME NOT NULL, email VARCHAR(120) NOT NULL, phone VARCHAR(15) NOT NULL, firstname VARCHAR(65) NOT NULL, lastname VARCHAR(65) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_FE38F8448C03F15C ON appointment (employee_id)');
        $this->addSql('CREATE INDEX IDX_FE38F844549213EC ON appointment (property_id)');
        $this->addSql('DROP INDEX IDX_16DB4F89549213EC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__picture AS SELECT id, property_id, name FROM picture');
        $this->addSql('DROP TABLE picture');
        $this->addSql('CREATE TABLE picture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, property_id INTEGER NOT NULL, name VARCHAR(40) NOT NULL COLLATE BINARY, CONSTRAINT FK_16DB4F89549213EC FOREIGN KEY (property_id) REFERENCES property (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO picture (id, property_id, name) SELECT id, property_id, name FROM __temp__picture');
        $this->addSql('DROP TABLE __temp__picture');
        $this->addSql('CREATE INDEX IDX_16DB4F89549213EC ON picture (property_id)');
        $this->addSql('DROP INDEX IDX_8BF21CDE8C03F15C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__property AS SELECT id, employee_id, title, surface, content, price, floor, rooms, address, zipcode, city, type, transaction_type, ground_size, date_of_construction, sell, slug FROM property');
        $this->addSql('DROP TABLE property');
        $this->addSql('CREATE TABLE property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, employee_id INTEGER NOT NULL, title VARCHAR(120) NOT NULL COLLATE BINARY, surface INTEGER NOT NULL, content CLOB DEFAULT NULL COLLATE BINARY, price INTEGER NOT NULL, floor VARCHAR(3) DEFAULT NULL COLLATE BINARY, rooms INTEGER NOT NULL, address VARCHAR(255) NOT NULL COLLATE BINARY, zipcode VARCHAR(10) NOT NULL COLLATE BINARY, city VARCHAR(65) NOT NULL COLLATE BINARY, type VARCHAR(40) NOT NULL COLLATE BINARY, transaction_type BOOLEAN NOT NULL, ground_size INTEGER DEFAULT NULL, date_of_construction DATE DEFAULT NULL, sell BOOLEAN NOT NULL, slug VARCHAR(120) NOT NULL COLLATE BINARY, CONSTRAINT FK_8BF21CDE8C03F15C FOREIGN KEY (employee_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO property (id, employee_id, title, surface, content, price, floor, rooms, address, zipcode, city, type, transaction_type, ground_size, date_of_construction, sell, slug) SELECT id, employee_id, title, surface, content, price, floor, rooms, address, zipcode, city, type, transaction_type, ground_size, date_of_construction, sell, slug FROM __temp__property');
        $this->addSql('DROP TABLE __temp__property');
        $this->addSql('CREATE INDEX IDX_8BF21CDE8C03F15C ON property (employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP INDEX IDX_16DB4F89549213EC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__picture AS SELECT id, property_id, name FROM picture');
        $this->addSql('DROP TABLE picture');
        $this->addSql('CREATE TABLE picture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, property_id INTEGER NOT NULL, name VARCHAR(40) NOT NULL)');
        $this->addSql('INSERT INTO picture (id, property_id, name) SELECT id, property_id, name FROM __temp__picture');
        $this->addSql('DROP TABLE __temp__picture');
        $this->addSql('CREATE INDEX IDX_16DB4F89549213EC ON picture (property_id)');
        $this->addSql('DROP INDEX IDX_8BF21CDE8C03F15C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__property AS SELECT id, employee_id, title, surface, content, price, floor, rooms, address, zipcode, city, type, transaction_type, ground_size, date_of_construction, sell, slug FROM property');
        $this->addSql('DROP TABLE property');
        $this->addSql('CREATE TABLE property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, employee_id INTEGER NOT NULL, title VARCHAR(120) NOT NULL, surface INTEGER NOT NULL, content CLOB DEFAULT NULL, price INTEGER NOT NULL, floor VARCHAR(3) DEFAULT NULL, rooms INTEGER NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(10) NOT NULL, city VARCHAR(65) NOT NULL, type VARCHAR(40) NOT NULL, transaction_type BOOLEAN NOT NULL, ground_size INTEGER DEFAULT NULL, date_of_construction DATE DEFAULT NULL, sell BOOLEAN NOT NULL, slug VARCHAR(120) NOT NULL)');
        $this->addSql('INSERT INTO property (id, employee_id, title, surface, content, price, floor, rooms, address, zipcode, city, type, transaction_type, ground_size, date_of_construction, sell, slug) SELECT id, employee_id, title, surface, content, price, floor, rooms, address, zipcode, city, type, transaction_type, ground_size, date_of_construction, sell, slug FROM __temp__property');
        $this->addSql('DROP TABLE __temp__property');
        $this->addSql('CREATE INDEX IDX_8BF21CDE8C03F15C ON property (employee_id)');
    }
}
