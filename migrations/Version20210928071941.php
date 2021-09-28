<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210928071941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, property_id INTEGER NOT NULL, name VARCHAR(40) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_16DB4F89549213EC ON picture (property_id)');
        $this->addSql('CREATE TABLE property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, employee_id INTEGER NOT NULL, title VARCHAR(120) NOT NULL, surface INTEGER NOT NULL, content CLOB DEFAULT NULL, price INTEGER NOT NULL, floor VARCHAR(3) DEFAULT NULL, rooms INTEGER NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(10) NOT NULL, city VARCHAR(65) NOT NULL, type VARCHAR(40) NOT NULL, transaction_type BOOLEAN NOT NULL, ground_size INTEGER DEFAULT NULL, date_of_construction DATE DEFAULT NULL, sell BOOLEAN NOT NULL, slug VARCHAR(120) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_8BF21CDE8C03F15C ON property (employee_id)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, firstname VARCHAR(65) NOT NULL, lastname VARCHAR(65) NOT NULL, phone VARCHAR(14) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE "user"');
    }
}
