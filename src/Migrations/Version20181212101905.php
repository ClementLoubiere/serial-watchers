<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181212101905 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, serie_id INT NOT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, publication_date DATETIME NOT NULL, INDEX IDX_D782112DD94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, serie_id INT DEFAULT NULL, nb_seasons INT NOT NULL, INDEX IDX_F0E45BA9D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112DD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE product ADD category VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE episode ADD title VARCHAR(255) NOT NULL, ADD description VARCHAR(255) NOT NULL, ADD nb_episodes INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDAA1CDA2B36786B ON episode (title)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP INDEX UNIQ_DDAA1CDA2B36786B ON episode');
        $this->addSql('ALTER TABLE episode DROP title, DROP description, DROP nb_episodes');
        $this->addSql('ALTER TABLE product DROP category');
    }
}
