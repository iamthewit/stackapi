<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191013164912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE answer_entity (id CHAR(36) NOT NULL --(DC2Type:guid)
        , question_id CHAR(36) NOT NULL --(DC2Type:guid)
        , user_id CHAR(36) NOT NULL --(DC2Type:guid)
        , text CLOB NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , deleted_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FCD17ECF1E27F6BF ON answer_entity (question_id)');
        $this->addSql('CREATE INDEX IDX_FCD17ECFA76ED395 ON answer_entity (user_id)');
        $this->addSql('CREATE TABLE question (id CHAR(36) NOT NULL --(DC2Type:guid)
        , question_group_id CHAR(36) NOT NULL --(DC2Type:guid)
        , user_id CHAR(36) NOT NULL --(DC2Type:guid)
        , text VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , deleted_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494E9D5C694B ON question (question_group_id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EA76ED395 ON question (user_id)');
        $this->addSql('DROP INDEX IDX_5D2B55C1A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__question_group AS SELECT id, user_id, name, created_at, updated_at, deleted_at FROM question_group');
        $this->addSql('DROP TABLE question_group');
        $this->addSql('CREATE TABLE question_group (id CHAR(36) NOT NULL --(DC2Type:guid)
        , user_id CHAR(36) NOT NULL --(DC2Type:guid)
        , name VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , deleted_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id), CONSTRAINT FK_5D2B55C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO question_group (id, user_id, name, created_at, updated_at, deleted_at) SELECT id, user_id, name, created_at, updated_at, deleted_at FROM __temp__question_group');
        $this->addSql('DROP TABLE __temp__question_group');
        $this->addSql('CREATE INDEX IDX_5D2B55C1A76ED395 ON question_group (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, email, password, created_at, updated_at, deleted_at FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL --(DC2Type:guid)
        , username VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(255) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , deleted_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user (id, username, email, password, created_at, updated_at, deleted_at) SELECT id, username, email, password, created_at, updated_at, deleted_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE answer_entity');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP INDEX IDX_5D2B55C1A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__question_group AS SELECT id, user_id, name, created_at, updated_at, deleted_at FROM question_group');
        $this->addSql('DROP TABLE question_group');
        $this->addSql('CREATE TABLE question_group (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , user_id INTEGER NOT NULL, deleted_at DATETIME DEFAULT \'NULL --(DC2Type:datetime_immutable)\' --(DC2Type:datetime_immutable)
        , uuid CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:guid)
        )');
        $this->addSql('INSERT INTO question_group (id, user_id, name, created_at, updated_at, deleted_at) SELECT id, user_id, name, created_at, updated_at, deleted_at FROM __temp__question_group');
        $this->addSql('DROP TABLE __temp__question_group');
        $this->addSql('CREATE INDEX IDX_5D2B55C1A76ED395 ON question_group (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, email, password, created_at, updated_at, deleted_at FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , deleted_at DATETIME DEFAULT \'NULL --(DC2Type:datetime_immutable)\' --(DC2Type:datetime_immutable)
        , uuid CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:guid)
        )');
        $this->addSql('INSERT INTO user (id, username, email, password, created_at, updated_at, deleted_at) SELECT id, username, email, password, created_at, updated_at, deleted_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
