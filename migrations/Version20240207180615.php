<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207180615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact_question AS SELECT id, name, email, message FROM contact_question');
        $this->addSql('DROP TABLE contact_question');
        $this->addSql('CREATE TABLE contact_question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO contact_question (id, name, email, message) SELECT id, name, email, message FROM __temp__contact_question');
        $this->addSql('DROP TABLE __temp__contact_question');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL DEFAULT "[]" --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO user (id, username, password) SELECT id, username, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');

         // Insert an initial admin user with username 'admin' and password 'password'
         $this->addSql('INSERT INTO user (username, password) VALUES ("admin", "$2y$10$6pJzy6mHcMLNjqxvSv99Zu46GB22yKVZqlQh7n7c2sg72/3d2/xpW")');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact_question AS SELECT id, name, email, message FROM contact_question');
        $this->addSql('DROP TABLE contact_question');
        $this->addSql('CREATE TABLE contact_question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message CLOB NOT NULL)');
        $this->addSql('INSERT INTO contact_question (id, name, email, message) SELECT id, name, email, message FROM __temp__contact_question');
        $this->addSql('DROP TABLE __temp__contact_question');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, username, password) SELECT id, username, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
