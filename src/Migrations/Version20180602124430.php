<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180602124430 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, creation_date DATETIME NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE billet ADD type VARCHAR(255) NOT NULL, ADD is_half TINYINT(1) NOT NULL, DROP email, DROP coderesa, DROP numberresa, CHANGE visitdate visit_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE visitor ADD last_name VARCHAR(255) NOT NULL, ADD first_name VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, DROP firstname, DROP lastname, DROP reduction, DROP price, DROP numbervisitor, CHANGE birthday bithdate DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE tarif');
        $this->addSql('ALTER TABLE billet ADD coderesa VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD numberresa INT NOT NULL, DROP is_half, CHANGE type email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE visit_date visitdate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE visitor ADD firstname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD lastname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD reduction TINYINT(1) DEFAULT NULL, ADD price INT NOT NULL, ADD numbervisitor INT NOT NULL, DROP last_name, DROP first_name, DROP email, CHANGE bithdate birthday DATETIME NOT NULL');
    }
}
