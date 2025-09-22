<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250922121109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exigibilidade ALTER valor_pagamento TYPE NUMERIC(20, 2)');
        $this->addSql('ALTER TABLE exigibilidade ALTER valor_contratacao TYPE NUMERIC(20, 2)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exigibilidade ALTER valor_pagamento TYPE NUMERIC(15, 2)');
        $this->addSql('ALTER TABLE exigibilidade ALTER valor_contratacao TYPE NUMERIC(15, 2)');
    }
}
