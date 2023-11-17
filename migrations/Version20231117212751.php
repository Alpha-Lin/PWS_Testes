<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117212751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tentative DROP FOREIGN KEY FK_DBC382F9FB88E14F');
        $this->addSql('ALTER TABLE teste DROP FOREIGN KEY FK_E6B4490F73A201E5');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP INDEX IDX_DBC382F9FB88E14F ON tentative');
        $this->addSql('ALTER TABLE tentative ADD user_id INT DEFAULT NULL, DROP utilisateur_id');
        $this->addSql('ALTER TABLE tentative ADD CONSTRAINT FK_DBC382F9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DBC382F9A76ED395 ON tentative (user_id)');
        $this->addSql('DROP INDEX IDX_E6B4490F73A201E5 ON teste');
        $this->addSql('ALTER TABLE teste ADD user_id INT DEFAULT NULL, DROP createur_id');
        $this->addSql('ALTER TABLE teste ADD CONSTRAINT FK_E6B4490FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E6B4490FA76ED395 ON teste (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, mail_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mot_de_passe_utilisateur VARCHAR(97) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, id_utilisateur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tentative DROP FOREIGN KEY FK_DBC382F9A76ED395');
        $this->addSql('DROP INDEX IDX_DBC382F9A76ED395 ON tentative');
        $this->addSql('ALTER TABLE tentative ADD utilisateur_id INT NOT NULL, DROP user_id');
        $this->addSql('ALTER TABLE tentative ADD CONSTRAINT FK_DBC382F9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_DBC382F9FB88E14F ON tentative (utilisateur_id)');
        $this->addSql('ALTER TABLE teste DROP FOREIGN KEY FK_E6B4490FA76ED395');
        $this->addSql('DROP INDEX IDX_E6B4490FA76ED395 ON teste');
        $this->addSql('ALTER TABLE teste ADD createur_id INT NOT NULL, DROP user_id');
        $this->addSql('ALTER TABLE teste ADD CONSTRAINT FK_E6B4490F73A201E5 FOREIGN KEY (createur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_E6B4490F73A201E5 ON teste (createur_id)');
    }
}
