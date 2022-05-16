<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516181309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE participation_user');
        $this->addSql('ALTER TABLE user ADD participation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496ACE3B73 ON user (participation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation_user (participation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_51E76900A76ED395 (user_id), INDEX IDX_51E769006ACE3B73 (participation_id), PRIMARY KEY(participation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participation_user ADD CONSTRAINT FK_51E76900A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_user ADD CONSTRAINT FK_51E769006ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496ACE3B73');
        $this->addSql('DROP INDEX IDX_8D93D6496ACE3B73 ON user');
        $this->addSql('ALTER TABLE user DROP participation_id');
    }
}
