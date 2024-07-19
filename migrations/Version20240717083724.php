<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240717083724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add githubId to User entity if not exists';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            SET @dbname = DATABASE();
            SET @tablename = "user";
            SET @columnname = "github_id";
            SET @preparedStatement = (SELECT IF(
              (
                SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
                WHERE
                  TABLE_SCHEMA = @dbname
                  AND TABLE_NAME = @tablename
                  AND COLUMN_NAME = @columnname
              ) > 0,
              "SELECT 1",
              CONCAT("ALTER TABLE ", @tablename, " ADD ", @columnname, " VARCHAR(255) DEFAULT NULL")
            ));
            PREPARE alterIfNotExists FROM @preparedStatement;
            EXECUTE alterIfNotExists;
            DEALLOCATE PREPARE alterIfNotExists;
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP github_id');
    }
}
