<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201133053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teste DROP FOREIGN KEY FK_E6B4490F73A201E5');
        $this->addSql('ALTER TABLE tentative DROP FOREIGN KEY FK_DBC382F9FB88E14F');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, objet VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, been_send TINYINT(1) NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307FCD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_teste (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rememberme_token (series VARCHAR(88) NOT NULL, value VARCHAR(88) NOT NULL, lastUsed DATETIME NOT NULL, class VARCHAR(100) NOT NULL, username VARCHAR(200) NOT NULL, PRIMARY KEY(series)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE critere DROP id_critere');
        $this->addSql('ALTER TABLE question DROP id_question');
        $this->addSql('ALTER TABLE solution DROP id_solution');
        $this->addSql('DROP INDEX IDX_DBC382F9FB88E14F ON tentative');
        $this->addSql('ALTER TABLE tentative ADD user_id INT DEFAULT NULL, DROP utilisateur_id, DROP id_tentative');
        $this->addSql('ALTER TABLE tentative ADD CONSTRAINT FK_DBC382F9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DBC382F9A76ED395 ON tentative (user_id)');
        $this->addSql('DROP INDEX IDX_E6B4490F73A201E5 ON teste');
        $this->addSql('ALTER TABLE teste ADD user_id INT DEFAULT NULL, ADD type_teste_id INT DEFAULT NULL, ADD label VARCHAR(255) NOT NULL, ADD description LONGTEXT DEFAULT NULL, DROP createur_id, DROP id_teste, CHANGE image_teste image_teste VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE teste ADD CONSTRAINT FK_E6B4490FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE teste ADD CONSTRAINT FK_E6B4490F4D5526CE FOREIGN KEY (type_teste_id) REFERENCES type_teste (id)');
        $this->addSql('CREATE INDEX IDX_E6B4490FA76ED395 ON teste (user_id)');
        $this->addSql('CREATE INDEX IDX_E6B4490F4D5526CE ON teste (type_teste_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teste DROP FOREIGN KEY FK_E6B4490F4D5526CE');
        $this->addSql('ALTER TABLE tentative DROP FOREIGN KEY FK_DBC382F9A76ED395');
        $this->addSql('ALTER TABLE teste DROP FOREIGN KEY FK_E6B4490FA76ED395');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, mail_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mot_de_passe_utilisateur VARCHAR(97) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, id_utilisateur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FCD53EDB6');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE type_teste');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE rememberme_token');
        $this->addSql('ALTER TABLE critere ADD id_critere INT NOT NULL');
        $this->addSql('DROP INDEX IDX_E6B4490FA76ED395 ON teste');
        $this->addSql('DROP INDEX IDX_E6B4490F4D5526CE ON teste');
        $this->addSql('ALTER TABLE teste ADD createur_id INT NOT NULL, ADD id_teste INT NOT NULL, DROP user_id, DROP type_teste_id, DROP label, DROP description, CHANGE image_teste image_teste LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE teste ADD CONSTRAINT FK_E6B4490F73A201E5 FOREIGN KEY (createur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E6B4490F73A201E5 ON teste (createur_id)');
        $this->addSql('DROP INDEX IDX_DBC382F9A76ED395 ON tentative');
        $this->addSql('ALTER TABLE tentative ADD utilisateur_id INT NOT NULL, ADD id_tentative INT NOT NULL, DROP user_id');
        $this->addSql('ALTER TABLE tentative ADD CONSTRAINT FK_DBC382F9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DBC382F9FB88E14F ON tentative (utilisateur_id)');
        $this->addSql('ALTER TABLE question ADD id_question INT NOT NULL');
        $this->addSql('ALTER TABLE solution ADD id_solution INT NOT NULL');
    }
}
