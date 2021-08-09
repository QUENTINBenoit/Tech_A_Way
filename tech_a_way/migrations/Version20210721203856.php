<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721203856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD mode_of_payment_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398C9A9CD82 FOREIGN KEY (mode_of_payment_id) REFERENCES mode_of_payment (id)');
        $this->addSql('CREATE INDEX IDX_F5299398C9A9CD82 ON `order` (mode_of_payment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398C9A9CD82');
        $this->addSql('DROP INDEX IDX_F5299398C9A9CD82 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP mode_of_payment_id');
    }
}
