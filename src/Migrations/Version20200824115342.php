<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200824115342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE athlete (id INT AUTO_INCREMENT NOT NULL, sexe_id INT DEFAULT NULL, ecole_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, taille INT NOT NULL, poids INT NOT NULL, filiere VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, INDEX IDX_C03B8321448F3B3C (sexe_id), INDEX IDX_C03B832177EF1B1E (ecole_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B8321448F3B3C FOREIGN KEY (sexe_id) REFERENCES sexe (id)');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B832177EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE athlete');
    }
}
