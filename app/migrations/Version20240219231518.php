<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219231518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add is_verified column to user table';
    }

    public function up(Schema $schema): void
    {
        $userTable = $schema->getTable('user');
        $userTable->addColumn('is_verified', 'boolean', ['notnull' => true, 'default' => false]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $userTable = $schema->getTable('user');
        $userTable->dropColumn('is_verified');
    }
}
