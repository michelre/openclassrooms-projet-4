<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180613113717 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservation ADD tarif_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A67005A7 FOREIGN KEY (tarif_id_id) REFERENCES tarif (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C84955A67005A7 ON reservation (tarif_id_id)');
        $this->addSql('ALTER TABLE tarif ADD billet_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C9213B8384 FOREIGN KEY (billet_id_id) REFERENCES billet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7189C9213B8384 ON tarif (billet_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A67005A7');
        $this->addSql('DROP INDEX UNIQ_42C84955A67005A7 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP tarif_id_id');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C9213B8384');
        $this->addSql('DROP INDEX UNIQ_E7189C9213B8384 ON tarif');
        $this->addSql('ALTER TABLE tarif DROP billet_id_id');
    }
}
