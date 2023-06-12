<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316183916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tasas DROP FOREIGN KEY FK_AAB78D1DFC28E5EE');
        $this->addSql('DROP INDEX IDX_AAB78D1DFC28E5EE ON tasas');
        $this->addSql('ALTER TABLE tasas CHANGE alumno_id hijos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tasas ADD CONSTRAINT FK_AAB78D1D2A85B2A1 FOREIGN KEY (hijos_id) REFERENCES hijos (id)');
        $this->addSql('CREATE INDEX IDX_AAB78D1D2A85B2A1 ON tasas (hijos_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tasas DROP FOREIGN KEY FK_AAB78D1D2A85B2A1');
        $this->addSql('DROP INDEX IDX_AAB78D1D2A85B2A1 ON tasas');
        $this->addSql('ALTER TABLE tasas CHANGE hijos_id alumno_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tasas ADD CONSTRAINT FK_AAB78D1DFC28E5EE FOREIGN KEY (alumno_id) REFERENCES hijos (id)');
        $this->addSql('CREATE INDEX IDX_AAB78D1DFC28E5EE ON tasas (alumno_id)');
    }
}
