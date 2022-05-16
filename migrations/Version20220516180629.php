<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516180629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation_user (participation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_51E769006ACE3B73 (participation_id), INDEX IDX_51E76900A76ED395 (user_id), PRIMARY KEY(participation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participation_user ADD CONSTRAINT FK_51E769006ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_user ADD CONSTRAINT FK_51E76900A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD participation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE6ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE6ACE3B73 ON project (participation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation_user DROP FOREIGN KEY FK_51E769006ACE3B73');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE6ACE3B73');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE participation_user');
        $this->addSql('DROP INDEX IDX_2FB3D0EE6ACE3B73 ON project');
        $this->addSql('ALTER TABLE project DROP participation_id');
    }
}
