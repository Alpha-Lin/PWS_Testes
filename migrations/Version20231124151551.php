<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124151551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_teste (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE teste CHANGE type_test type_teste_id INT NOT NULL');
        $this->addSql('ALTER TABLE teste ADD CONSTRAINT FK_E6B4490F4D5526CE FOREIGN KEY (type_teste_id) REFERENCES type_teste (id)');
        $this->addSql('CREATE INDEX IDX_E6B4490F4D5526CE ON teste (type_teste_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teste DROP FOREIGN KEY FK_E6B4490F4D5526CE');
        $this->addSql('DROP TABLE type_teste');
        $this->addSql('DROP INDEX IDX_E6B4490F4D5526CE ON teste');
        $this->addSql('ALTER TABLE teste CHANGE type_teste_id type_test INT NOT NULL');
    }
}
