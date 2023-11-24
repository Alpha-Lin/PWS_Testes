<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124150057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere DROP id_critere');
        $this->addSql('ALTER TABLE question DROP id_question');
        $this->addSql('ALTER TABLE solution DROP id_solution');
        $this->addSql('ALTER TABLE tentative DROP id_tentative');
        $this->addSql('ALTER TABLE teste DROP id_teste');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere ADD id_critere INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD id_question INT NOT NULL');
        $this->addSql('ALTER TABLE solution ADD id_solution INT NOT NULL');
        $this->addSql('ALTER TABLE tentative ADD id_tentative INT NOT NULL');
        $this->addSql('ALTER TABLE teste ADD id_teste INT NOT NULL');
    }
}
