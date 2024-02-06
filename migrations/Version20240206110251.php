<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206110251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Create the contact_question table
        $this->addSql('CREATE TABLE contact_question (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            message TEXT NOT NULL
        )');

        // Create the user table for admin users
        $this->addSql('CREATE TABLE user (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        )');

        // Insert an initial admin user with username 'admin' and password 'password'
        $this->addSql('INSERT INTO user (username, password) VALUES ("admin", "$2y$10$6pJzy6mHcMLNjqxvSv99Zu46GB22yKVZqlQh7n7c2sg72/3d2/xpW")');
    }

    public function down(Schema $schema): void
    {
        // Drop the contact_question table
        $this->addSql('DROP TABLE contact_question');

        // Drop the user table
        $this->addSql('DROP TABLE user');
    }
}
