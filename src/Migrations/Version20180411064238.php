<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180411064238 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $sql = 'CREATE TABLE `user` (
        `id` int(10) NULL,
        `first_name` varchar(255) NOT NULL,
        `second_name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `city` varchar(255) NOT NULL,
        `country` varchar(255) NOT NULL,
        `password` varchar(64) NOT NULL,
        `birthday` datetime NOT NULL,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;ALTER TABLE `users` ADD PRIMARY KEY (`id`);';
        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE users;');
    }
}
