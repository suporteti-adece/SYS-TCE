<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250917171419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Criação da tabela exigibilidade';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exigibilidade (id UUID NOT NULL, exercicio INT NOT NULL, semestre VARCHAR(2) NOT NULL, cod_orgao VARCHAR(6) NOT NULL, cod_fonte_recurso VARCHAR(2) NOT NULL, tipo_recurso VARCHAR(2) NOT NULL, num_contrato_emprestimo VARCHAR(30) DEFAULT NULL, ano_contrato_emprestimo INT NOT NULL, num_convenio VARCHAR(30) DEFAULT NULL, ano_convenio INT NOT NULL, num_nota_fiscal VARCHAR(30) NOT NULL, data_nota_fiscal INT NOT NULL, data_atesto INT NOT NULL, id_pagamento VARCHAR(20) NOT NULL, data_pagamento INT NOT NULL, valor_pagamento NUMERIC(15, 2) NOT NULL, num_contrato VARCHAR(30) NOT NULL, ano_contrato VARCHAR(4) NOT NULL, valor_contratacao NUMERIC(15, 2) NOT NULL, cpf_cnpj_credor VARCHAR(18) NOT NULL, tipo_exigibilidade VARCHAR(2) NOT NULL, justificativa VARCHAR(254) DEFAULT NULL, PRIMARY KEY (id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE exigibilidade');
    }
}
