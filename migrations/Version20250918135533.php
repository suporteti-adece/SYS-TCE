<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250918135533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exigibilidade ALTER exercicio TYPE VARCHAR(4)');
        $this->addSql('ALTER TABLE exigibilidade ALTER ano_contrato_emprestimo TYPE VARCHAR(4)');
        $this->addSql('ALTER TABLE exigibilidade ALTER ano_convenio TYPE VARCHAR(4)');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_nota_fiscal TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_atesto TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_pagamento TYPE VARCHAR(10)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exigibilidade ALTER exercicio TYPE INT');
        $this->addSql('ALTER TABLE exigibilidade ALTER ano_contrato_emprestimo TYPE INT');
        $this->addSql('ALTER TABLE exigibilidade ALTER ano_convenio TYPE INT');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_nota_fiscal TYPE INT');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_atesto TYPE INT');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_pagamento TYPE INT');
    }
}
