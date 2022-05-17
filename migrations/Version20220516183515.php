<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516183515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation ADD projects_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F1EDE0F55 FOREIGN KEY (projects_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F1EDE0F55 ON participation (projects_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F1EDE0F55');
        $this->addSql('DROP INDEX IDX_AB55E24F1EDE0F55 ON participation');
        $this->addSql('ALTER TABLE participation DROP projects_id');
    }
}
