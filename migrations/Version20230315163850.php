<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315163850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grupos ADD profesor_id INT NOT NULL');
        $this->addSql('ALTER TABLE grupos ADD CONSTRAINT FK_45842FEE52BD977 FOREIGN KEY (profesor_id) REFERENCES profesor (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45842FEE52BD977 ON grupos (profesor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grupos DROP FOREIGN KEY FK_45842FEE52BD977');
        $this->addSql('DROP INDEX UNIQ_45842FEE52BD977 ON grupos');
        $this->addSql('ALTER TABLE grupos DROP profesor_id');
    }
}
