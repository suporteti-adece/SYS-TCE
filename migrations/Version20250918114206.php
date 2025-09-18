<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250918114206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exigibilidade ALTER cod_orgao TYPE INT USING cod_orgao::integer');
        $this->addSql('ALTER TABLE exigibilidade ALTER cod_fonte_recurso DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER tipo_recurso DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER ano_contrato_emprestimo DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER ano_convenio DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER num_nota_fiscal DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_nota_fiscal DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_atesto DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER id_pagamento DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_pagamento DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER valor_pagamento DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER num_contrato DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER ano_contrato DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER valor_contratacao DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER cpf_cnpj_credor DROP NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER tipo_exigibilidade DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exigibilidade ALTER cod_orgao TYPE VARCHAR(6)');
        $this->addSql('ALTER TABLE exigibilidade ALTER cod_fonte_recurso SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER tipo_recurso SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER ano_contrato_emprestimo SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER ano_convenio SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER num_nota_fiscal SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_nota_fiscal SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_atesto SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER id_pagamento SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER data_pagamento SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER valor_pagamento SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER num_contrato SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER ano_contrato SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER valor_contratacao SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER cpf_cnpj_credor SET NOT NULL');
        $this->addSql('ALTER TABLE exigibilidade ALTER tipo_exigibilidade SET NOT NULL');
    }
}
