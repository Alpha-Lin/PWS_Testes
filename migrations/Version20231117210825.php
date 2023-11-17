<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117210825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE critere (id INT AUTO_INCREMENT NOT NULL, teste_id INT NOT NULL, id_critere INT NOT NULL, score_max DOUBLE PRECISION NOT NULL, score_defaut DOUBLE PRECISION NOT NULL, interpretation_max_texte VARCHAR(255) NOT NULL, interpretation_min_texte VARCHAR(255) NOT NULL, interpretation_max_couleur INT NOT NULL, interpretation_min_couleur INT NOT NULL, interpretation_max_image LONGBLOB NOT NULL, interpretation_min_image LONGBLOB NOT NULL, INDEX IDX_7F6A805380AA0132 (teste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere_solution (critere_id INT NOT NULL, solution_id INT NOT NULL, INDEX IDX_7CA5386D9E5F45AB (critere_id), INDEX IDX_7CA5386D1C0BE183 (solution_id), PRIMARY KEY(critere_id, solution_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, teste_id INT NOT NULL, id_question INT NOT NULL, question VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E80AA0132 (teste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solution (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, id_solution INT NOT NULL, nom_solution VARCHAR(255) NOT NULL, INDEX IDX_9F3329DB1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solution_tentative (solution_id INT NOT NULL, tentative_id INT NOT NULL, INDEX IDX_D3E31E91C0BE183 (solution_id), INDEX IDX_D3E31E9D78CE477 (tentative_id), PRIMARY KEY(solution_id, tentative_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tentative (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, teste_id INT NOT NULL, id_tentative INT NOT NULL, date_tentative DATETIME NOT NULL, INDEX IDX_DBC382F9FB88E14F (utilisateur_id), INDEX IDX_DBC382F980AA0132 (teste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teste (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, id_teste INT NOT NULL, image_teste LONGBLOB DEFAULT NULL, INDEX IDX_E6B4490F73A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, mail_utilisateur VARCHAR(255) NOT NULL, nom_utilisateur VARCHAR(255) NOT NULL, mot_de_passe_utilisateur VARCHAR(97) NOT NULL, id_utilisateur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A805380AA0132 FOREIGN KEY (teste_id) REFERENCES teste (id)');
        $this->addSql('ALTER TABLE critere_solution ADD CONSTRAINT FK_7CA5386D9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_solution ADD CONSTRAINT FK_7CA5386D1C0BE183 FOREIGN KEY (solution_id) REFERENCES solution (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E80AA0132 FOREIGN KEY (teste_id) REFERENCES teste (id)');
        $this->addSql('ALTER TABLE solution ADD CONSTRAINT FK_9F3329DB1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE solution_tentative ADD CONSTRAINT FK_D3E31E91C0BE183 FOREIGN KEY (solution_id) REFERENCES solution (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE solution_tentative ADD CONSTRAINT FK_D3E31E9D78CE477 FOREIGN KEY (tentative_id) REFERENCES tentative (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tentative ADD CONSTRAINT FK_DBC382F9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE tentative ADD CONSTRAINT FK_DBC382F980AA0132 FOREIGN KEY (teste_id) REFERENCES teste (id)');
        $this->addSql('ALTER TABLE teste ADD CONSTRAINT FK_E6B4490F73A201E5 FOREIGN KEY (createur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A805380AA0132');
        $this->addSql('ALTER TABLE critere_solution DROP FOREIGN KEY FK_7CA5386D9E5F45AB');
        $this->addSql('ALTER TABLE critere_solution DROP FOREIGN KEY FK_7CA5386D1C0BE183');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E80AA0132');
        $this->addSql('ALTER TABLE solution DROP FOREIGN KEY FK_9F3329DB1E27F6BF');
        $this->addSql('ALTER TABLE solution_tentative DROP FOREIGN KEY FK_D3E31E91C0BE183');
        $this->addSql('ALTER TABLE solution_tentative DROP FOREIGN KEY FK_D3E31E9D78CE477');
        $this->addSql('ALTER TABLE tentative DROP FOREIGN KEY FK_DBC382F9FB88E14F');
        $this->addSql('ALTER TABLE tentative DROP FOREIGN KEY FK_DBC382F980AA0132');
        $this->addSql('ALTER TABLE teste DROP FOREIGN KEY FK_E6B4490F73A201E5');
        $this->addSql('DROP TABLE critere');
        $this->addSql('DROP TABLE critere_solution');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE solution');
        $this->addSql('DROP TABLE solution_tentative');
        $this->addSql('DROP TABLE tentative');
        $this->addSql('DROP TABLE teste');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
