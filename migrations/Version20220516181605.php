<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516181605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation ADD user_id INT DEFAULT NULL, ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24FA76ED395 ON participation (user_id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F166D1F9C ON participation (project_id)');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE6ACE3B73');
        $this->addSql('DROP INDEX IDX_2FB3D0EE6ACE3B73 ON project');
        $this->addSql('ALTER TABLE project DROP participation_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496ACE3B73');
        $this->addSql('DROP INDEX IDX_8D93D6496ACE3B73 ON user');
        $this->addSql('ALTER TABLE user DROP participation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FA76ED395');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F166D1F9C');
        $this->addSql('DROP INDEX IDX_AB55E24FA76ED395 ON participation');
        $this->addSql('DROP INDEX IDX_AB55E24F166D1F9C ON participation');
        $this->addSql('ALTER TABLE participation DROP user_id, DROP project_id');
        $this->addSql('ALTER TABLE project ADD participation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE6ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE6ACE3B73 ON project (participation_id)');
        $this->addSql('ALTER TABLE user ADD participation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496ACE3B73 ON user (participation_id)');
    }
}
