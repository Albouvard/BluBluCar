<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407013727 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE itineraire (id INT AUTO_INCREMENT NOT NULL, id_voyage_id INT NOT NULL, id_depart_id INT NOT NULL, id_arrive_id INT NOT NULL, INDEX IDX_487C9A11E8FC5988 (id_voyage_id), INDEX IDX_487C9A112E37426C (id_depart_id), INDEX IDX_487C9A1174373A6F (id_arrive_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usager (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, ddn_at DATETIME NOT NULL, pseudo VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, motdepasse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, id_conducteur_id INT NOT NULL, horaire_at DATETIME NOT NULL, nb_places INT NOT NULL, INDEX IDX_3F9D89554F479BA3 (id_conducteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_usager (id INT AUTO_INCREMENT NOT NULL, id_voyage_id INT NOT NULL, id_usager_id INT NOT NULL, nb_reservation INT NOT NULL, INDEX IDX_C630A2AE8FC5988 (id_voyage_id), INDEX IDX_C630A2ACF034CDB (id_usager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE itineraire ADD CONSTRAINT FK_487C9A11E8FC5988 FOREIGN KEY (id_voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE itineraire ADD CONSTRAINT FK_487C9A112E37426C FOREIGN KEY (id_depart_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE itineraire ADD CONSTRAINT FK_487C9A1174373A6F FOREIGN KEY (id_arrive_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554F479BA3 FOREIGN KEY (id_conducteur_id) REFERENCES usager (id)');
        $this->addSql('ALTER TABLE voyage_usager ADD CONSTRAINT FK_C630A2AE8FC5988 FOREIGN KEY (id_voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE voyage_usager ADD CONSTRAINT FK_C630A2ACF034CDB FOREIGN KEY (id_usager_id) REFERENCES usager (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554F479BA3');
        $this->addSql('ALTER TABLE voyage_usager DROP FOREIGN KEY FK_C630A2ACF034CDB');
        $this->addSql('ALTER TABLE itineraire DROP FOREIGN KEY FK_487C9A112E37426C');
        $this->addSql('ALTER TABLE itineraire DROP FOREIGN KEY FK_487C9A1174373A6F');
        $this->addSql('ALTER TABLE itineraire DROP FOREIGN KEY FK_487C9A11E8FC5988');
        $this->addSql('ALTER TABLE voyage_usager DROP FOREIGN KEY FK_C630A2AE8FC5988');
        $this->addSql('DROP TABLE itineraire');
        $this->addSql('DROP TABLE usager');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('DROP TABLE voyage_usager');
    }
}
