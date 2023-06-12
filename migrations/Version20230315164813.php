<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315164813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hijos ADD notificacion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hijos ADD CONSTRAINT FK_47676A004D633FC4 FOREIGN KEY (notificacion_id) REFERENCES notificacion (id)');
        $this->addSql('CREATE INDEX IDX_47676A004D633FC4 ON hijos (notificacion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hijos DROP FOREIGN KEY FK_47676A004D633FC4');
        $this->addSql('DROP INDEX IDX_47676A004D633FC4 ON hijos');
        $this->addSql('ALTER TABLE hijos DROP notificacion_id');
    }
}
