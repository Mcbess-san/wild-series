<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607005937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE number number INT DEFAULT NULL, CHANGE synopsis synopsis LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE program CHANGE poster poster VARCHAR(255) DEFAULT NULL, CHANGE year year INT DEFAULT NULL');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9E12DEDA1');
        $this->addSql('DROP INDEX IDX_F0E45BA9E12DEDA1 ON season');
        $this->addSql('ALTER TABLE season CHANGE number number INT DEFAULT NULL, CHANGE year year INT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE program_id_id program_id INT NOT NULL');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA93EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('CREATE INDEX IDX_F0E45BA93EB8070A ON season (program_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE number number INT NOT NULL, CHANGE synopsis synopsis LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE program CHANGE poster poster VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE year year INT NOT NULL');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA93EB8070A');
        $this->addSql('DROP INDEX IDX_F0E45BA93EB8070A ON season');
        $this->addSql('ALTER TABLE season CHANGE number number INT NOT NULL, CHANGE year year INT NOT NULL, CHANGE description description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE program_id program_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9E12DEDA1 FOREIGN KEY (program_id_id) REFERENCES program (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F0E45BA9E12DEDA1 ON season (program_id_id)');
    }
}
