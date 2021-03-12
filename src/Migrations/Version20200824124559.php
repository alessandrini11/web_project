<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200824124559 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, date_publication DATETIME NOT NULL, lieu VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition_entraineur (competition_id INT NOT NULL, entraineur_id INT NOT NULL, INDEX IDX_9E339EBF7B39D312 (competition_id), INDEX IDX_9E339EBFF8478A1 (entraineur_id), PRIMARY KEY(competition_id, entraineur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competition_entraineur ADD CONSTRAINT FK_9E339EBF7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competition_entraineur ADD CONSTRAINT FK_9E339EBFF8478A1 FOREIGN KEY (entraineur_id) REFERENCES entraineur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE resultat ADD competition_id INT NOT NULL');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE27B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('CREATE INDEX IDX_E7DB5DE27B39D312 ON resultat (competition_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition_entraineur DROP FOREIGN KEY FK_9E339EBF7B39D312');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE27B39D312');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE competition_entraineur');
        $this->addSql('DROP INDEX IDX_E7DB5DE27B39D312 ON resultat');
        $this->addSql('ALTER TABLE resultat DROP competition_id');
    }
}
