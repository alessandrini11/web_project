<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200824142045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE entraineur DROP FOREIGN KEY FK_3D247E877B39D312');
        $this->addSql('DROP INDEX IDX_3D247E877B39D312 ON entraineur');
        $this->addSql('ALTER TABLE entraineur DROP competition_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE entraineur ADD competition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entraineur ADD CONSTRAINT FK_3D247E877B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('CREATE INDEX IDX_3D247E877B39D312 ON entraineur (competition_id)');
    }
}
