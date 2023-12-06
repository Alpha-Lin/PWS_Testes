<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206141233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere DROP interpretation_max_image, DROP interpretation_min_image');
        $this->addSql('ALTER TABLE critere_solution DROP FOREIGN KEY FK_7CA5386D500D642D');
        $this->addSql('DROP INDEX IDX_7CA5386D500D642D ON critere_solution');
        $this->addSql('ALTER TABLE critere_solution CHANGE tentativ_id tentative_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE critere_solution ADD CONSTRAINT FK_7CA5386DD78CE477 FOREIGN KEY (tentative_id) REFERENCES tentative (id)');
        $this->addSql('CREATE INDEX IDX_7CA5386DD78CE477 ON critere_solution (tentative_id)');
        $this->addSql('ALTER TABLE solution CHANGE question_id question_id INT NOT NULL');
        $this->addSql('ALTER TABLE tentative CHANGE teste_id teste_id INT NOT NULL');
        $this->addSql('ALTER TABLE type_teste ADD description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere ADD interpretation_max_image VARCHAR(255) DEFAULT NULL, ADD interpretation_min_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE critere_solution DROP FOREIGN KEY FK_7CA5386DD78CE477');
        $this->addSql('DROP INDEX IDX_7CA5386DD78CE477 ON critere_solution');
        $this->addSql('ALTER TABLE critere_solution CHANGE tentative_id tentativ_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE critere_solution ADD CONSTRAINT FK_7CA5386D500D642D FOREIGN KEY (tentativ_id) REFERENCES tentative (id)');
        $this->addSql('CREATE INDEX IDX_7CA5386D500D642D ON critere_solution (tentativ_id)');
        $this->addSql('ALTER TABLE solution CHANGE question_id question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tentative CHANGE teste_id teste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_teste DROP description');
    }
}
