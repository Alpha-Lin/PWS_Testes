<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201140502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere_solution DROP FOREIGN KEY FK_7CA5386D1C0BE183');
        $this->addSql('ALTER TABLE critere_solution DROP FOREIGN KEY FK_7CA5386D9E5F45AB');
        $this->addSql('DROP INDEX IDX_7CA5386D1C0BE183 ON critere_solution');
        $this->addSql('ALTER TABLE critere_solution ADD id INT AUTO_INCREMENT NOT NULL, ADD tentativ_id INT DEFAULT NULL, ADD point DOUBLE PRECISION NOT NULL, DROP solution_id, CHANGE critere_id critere_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE critere_solution ADD CONSTRAINT FK_7CA5386D500D642D FOREIGN KEY (tentativ_id) REFERENCES tentative (id)');
        $this->addSql('ALTER TABLE critere_solution ADD CONSTRAINT FK_7CA5386D9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('CREATE INDEX IDX_7CA5386D500D642D ON critere_solution (tentativ_id)');
        $this->addSql('ALTER TABLE message CHANGE objet objet VARCHAR(255) NOT NULL, CHANGE message message LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE solution ADD critere_id INT DEFAULT NULL, ADD point DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE solution ADD CONSTRAINT FK_9F3329DB9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('CREATE INDEX IDX_9F3329DB9E5F45AB ON solution (critere_id)');
        $this->addSql('ALTER TABLE teste CHANGE image_teste image_teste VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere_solution MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE critere_solution DROP FOREIGN KEY FK_7CA5386D500D642D');
        $this->addSql('ALTER TABLE critere_solution DROP FOREIGN KEY FK_7CA5386D9E5F45AB');
        $this->addSql('DROP INDEX IDX_7CA5386D500D642D ON critere_solution');
        $this->addSql('DROP INDEX `PRIMARY` ON critere_solution');
        $this->addSql('ALTER TABLE critere_solution ADD solution_id INT NOT NULL, DROP id, DROP tentativ_id, DROP point, CHANGE critere_id critere_id INT NOT NULL');
        $this->addSql('ALTER TABLE critere_solution ADD CONSTRAINT FK_7CA5386D1C0BE183 FOREIGN KEY (solution_id) REFERENCES solution (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_solution ADD CONSTRAINT FK_7CA5386D9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_7CA5386D1C0BE183 ON critere_solution (solution_id)');
        $this->addSql('ALTER TABLE critere_solution ADD PRIMARY KEY (critere_id, solution_id)');
        $this->addSql('ALTER TABLE message CHANGE objet objet VARCHAR(255) DEFAULT NULL, CHANGE message message LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE solution DROP FOREIGN KEY FK_9F3329DB9E5F45AB');
        $this->addSql('DROP INDEX IDX_9F3329DB9E5F45AB ON solution');
        $this->addSql('ALTER TABLE solution DROP critere_id, DROP point');
        $this->addSql('ALTER TABLE teste CHANGE image_teste image_teste LONGBLOB DEFAULT NULL');
    }
}
