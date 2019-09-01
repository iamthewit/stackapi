<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909180856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

//        $this->addSql('CREATE TABLE question_group (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, uuid CHAR(36) NOT NULL --(DC2Type:guid)
//        , name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
//        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
//        , deleted_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
//        )');
//        $this->addSql('CREATE INDEX IDX_5D2B55C1A76ED395 ON question_group (user_id)');
//        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, uuid CHAR(36) NOT NULL --(DC2Type:guid)
//        , username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
//        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
//        , deleted_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
//        )');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

//        $this->addSql('DROP TABLE question_group');
//        $this->addSql('DROP TABLE user');
    }
}
