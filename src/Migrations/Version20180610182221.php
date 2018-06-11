<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180610182221 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE billet ADD visitor_id INT NOT NULL');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF670BEE6D FOREIGN KEY (visitor_id) REFERENCES visitor (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F034AF670BEE6D ON billet (visitor_id)');
        $this->addSql('ALTER TABLE visitor DROP FOREIGN KEY FK_CAE5E19F44973C78');
        $this->addSql('DROP INDEX UNIQ_CAE5E19F44973C78 ON visitor');
        $this->addSql('ALTER TABLE visitor DROP billet_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF670BEE6D');
        $this->addSql('DROP INDEX UNIQ_1F034AF670BEE6D ON billet');
        $this->addSql('ALTER TABLE billet DROP visitor_id');
        $this->addSql('ALTER TABLE visitor ADD billet_id INT NOT NULL');
        $this->addSql('ALTER TABLE visitor ADD CONSTRAINT FK_CAE5E19F44973C78 FOREIGN KEY (billet_id) REFERENCES billet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CAE5E19F44973C78 ON visitor (billet_id)');
    }
}
