<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723102925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address CHANGE zipcode zipcode INT NOT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE zipcode_delivery zipcode_delivery INT NOT NULL, CHANGE zipcode_bill zipcode_bill INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address CHANGE zipcode zipcode SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE zipcode_delivery zipcode_delivery SMALLINT NOT NULL, CHANGE zipcode_bill zipcode_bill SMALLINT NOT NULL');
    }
}
