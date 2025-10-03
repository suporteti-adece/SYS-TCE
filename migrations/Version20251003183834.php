<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251003183834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adicionando campo razao_social na tabela exigibilidade';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE exigibilidade ADD razao_social VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE exigibilidade DROP razao_social');
    }
}
