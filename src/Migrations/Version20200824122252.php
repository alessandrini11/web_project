<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200824122252 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE discipline (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, sport VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, genre VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, olympique TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE athlete ADD discipline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B8321A5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id)');
        $this->addSql('CREATE INDEX IDX_C03B8321A5522701 ON athlete (discipline_id)');
        $this->addSql('ALTER TABLE entraineur ADD discipline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entraineur ADD CONSTRAINT FK_3D247E87A5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id)');
        $this->addSql('CREATE INDEX IDX_3D247E87A5522701 ON entraineur (discipline_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_C03B8321A5522701');
        $this->addSql('ALTER TABLE entraineur DROP FOREIGN KEY FK_3D247E87A5522701');
        $this->addSql('DROP TABLE discipline');
        $this->addSql('DROP INDEX IDX_C03B8321A5522701 ON athlete');
        $this->addSql('ALTER TABLE athlete DROP discipline_id');
        $this->addSql('DROP INDEX IDX_3D247E87A5522701 ON entraineur');
        $this->addSql('ALTER TABLE entraineur DROP discipline_id');
    }
}
