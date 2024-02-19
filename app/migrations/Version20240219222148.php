<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219222148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Created user table';
    }

    public function up(Schema $schema): void
    {
        $userTable = $schema->createTable('user');
        $userTable->addColumn('id', 'integer', ['autoincrement' => true]);
        $userTable->addColumn('email', 'string', ['length' => 180]);
        $userTable->addColumn('roles', 'json');
        $userTable->addColumn('password', 'string', ['length' => 255]);
        $userTable->setPrimaryKey(['id']);
        $userTable->addUniqueIndex(['email'], 'UNIQ_8D93D649E7927C74');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('user');
    }
}
