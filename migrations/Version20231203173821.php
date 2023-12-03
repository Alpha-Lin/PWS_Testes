<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231203173821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE critere (id INT AUTO_INCREMENT NOT NULL, teste_id INT NOT NULL, score_max DOUBLE PRECISION NOT NULL, score_defaut DOUBLE PRECISION NOT NULL, interpretation_max_texte VARCHAR(255) NOT NULL, interpretation_min_texte VARCHAR(255) NOT NULL, interpretation_max_couleur INT NOT NULL, interpretation_min_couleur INT NOT NULL, interpretation_max_image VARCHAR(255) DEFAULT NULL, interpretation_min_image VARCHAR(255) DEFAULT NULL, INDEX IDX_7F6A805380AA0132 (teste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere_solution (id INT AUTO_INCREMENT NOT NULL, tentativ_id INT DEFAULT NULL, critere_id INT DEFAULT NULL, point DOUBLE PRECISION NOT NULL, INDEX IDX_7CA5386D500D642D (tentativ_id), INDEX IDX_7CA5386D9E5F45AB (critere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, objet VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, been_send TINYINT(1) NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307FCD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, teste_id INT NOT NULL, question VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E80AA0132 (teste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solution (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, critere_id INT DEFAULT NULL, nom_solution VARCHAR(255) NOT NULL, point DOUBLE PRECISION NOT NULL, INDEX IDX_9F3329DB1E27F6BF (question_id), INDEX IDX_9F3329DB9E5F45AB (critere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solution_tentative (solution_id INT NOT NULL, tentative_id INT NOT NULL, INDEX IDX_D3E31E91C0BE183 (solution_id), INDEX IDX_D3E31E9D78CE477 (tentative_id), PRIMARY KEY(solution_id, tentative_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tentative (id INT AUTO_INCREMENT NOT NULL, teste_id INT NOT NULL, user_id INT DEFAULT NULL, date_tentative DATETIME NOT NULL, INDEX IDX_DBC382F980AA0132 (teste_id), INDEX IDX_DBC382F9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teste (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, type_teste_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_teste VARCHAR(255) DEFAULT NULL, INDEX IDX_E6B4490FA76ED395 (user_id), INDEX IDX_E6B4490F4D5526CE (type_teste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_teste (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, avatar LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rememberme_token (series VARCHAR(88) NOT NULL, value VARCHAR(88) NOT NULL, lastUsed DATETIME NOT NULL, class VARCHAR(100) NOT NULL, username VARCHAR(200) NOT NULL, PRIMARY KEY(series)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A805380AA0132 FOREIGN KEY (teste_id) REFERENCES teste (id)');
        $this->addSql('ALTER TABLE critere_solution ADD CONSTRAINT FK_7CA5386D500D642D FOREIGN KEY (tentativ_id) REFERENCES tentative (id)');
        $this->addSql('ALTER TABLE critere_solution ADD CONSTRAINT FK_7CA5386D9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E80AA0132 FOREIGN KEY (teste_id) REFERENCES teste (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE solution ADD CONSTRAINT FK_9F3329DB1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE solution ADD CONSTRAINT FK_9F3329DB9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('ALTER TABLE solution_tentative ADD CONSTRAINT FK_D3E31E91C0BE183 FOREIGN KEY (solution_id) REFERENCES solution (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE solution_tentative ADD CONSTRAINT FK_D3E31E9D78CE477 FOREIGN KEY (tentative_id) REFERENCES tentative (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tentative ADD CONSTRAINT FK_DBC382F980AA0132 FOREIGN KEY (teste_id) REFERENCES teste (id)');
        $this->addSql('ALTER TABLE tentative ADD CONSTRAINT FK_DBC382F9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE teste ADD CONSTRAINT FK_E6B4490FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE teste ADD CONSTRAINT FK_E6B4490F4D5526CE FOREIGN KEY (type_teste_id) REFERENCES type_teste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A805380AA0132');
        $this->addSql('ALTER TABLE critere_solution DROP FOREIGN KEY FK_7CA5386D500D642D');
        $this->addSql('ALTER TABLE critere_solution DROP FOREIGN KEY FK_7CA5386D9E5F45AB');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FCD53EDB6');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E80AA0132');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE solution DROP FOREIGN KEY FK_9F3329DB1E27F6BF');
        $this->addSql('ALTER TABLE solution DROP FOREIGN KEY FK_9F3329DB9E5F45AB');
        $this->addSql('ALTER TABLE solution_tentative DROP FOREIGN KEY FK_D3E31E91C0BE183');
        $this->addSql('ALTER TABLE solution_tentative DROP FOREIGN KEY FK_D3E31E9D78CE477');
        $this->addSql('ALTER TABLE tentative DROP FOREIGN KEY FK_DBC382F980AA0132');
        $this->addSql('ALTER TABLE tentative DROP FOREIGN KEY FK_DBC382F9A76ED395');
        $this->addSql('ALTER TABLE teste DROP FOREIGN KEY FK_E6B4490FA76ED395');
        $this->addSql('ALTER TABLE teste DROP FOREIGN KEY FK_E6B4490F4D5526CE');
        $this->addSql('DROP TABLE critere');
        $this->addSql('DROP TABLE critere_solution');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE solution');
        $this->addSql('DROP TABLE solution_tentative');
        $this->addSql('DROP TABLE tentative');
        $this->addSql('DROP TABLE teste');
        $this->addSql('DROP TABLE type_teste');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE rememberme_token');
    }
}
