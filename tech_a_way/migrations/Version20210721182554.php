<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721182554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_line ADD an_order_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE170A5F021 FOREIGN KEY (an_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_9CE58EE170A5F021 ON order_line (an_order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE170A5F021');
        $this->addSql('DROP INDEX IDX_9CE58EE170A5F021 ON order_line');
        $this->addSql('ALTER TABLE order_line DROP an_order_id');
    }
}
