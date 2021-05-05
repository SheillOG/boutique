<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311104051 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE panel ADD id INT AUTO_INCREMENT NOT NULL, DROP zdsq, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE panier CHANGE date_creation date_creation VARCHAR(50) NOT NULL, CHANGE montant_total montant_total NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE produit CHANGE image image VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (ID INT AUTO_INCREMENT NOT NULL, src TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, libelle TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE panel MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE panel DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE panel ADD zdsq INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE panier CHANGE date_creation date_creation DATETIME NOT NULL, CHANGE montant_total montant_total NUMERIC(15, 2) NOT NULL');
        $this->addSql('ALTER TABLE produit CHANGE image image TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
