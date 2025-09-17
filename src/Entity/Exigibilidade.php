<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class Exigibilidade
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    private ?Uuid $id = null;

    #[ORM\Column(length: 4)]
    private int $exercicio;

    #[ORM\Column(length: 2)]
    private string $semestre;

    #[ORM\Column(length: 6)]
    private string $codOrgao;

    #[ORM\Column(length: 2)]
    private string $codFonteRecurso;

    #[ORM\Column(length: 2)]
    private string $tipoRecurso;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $numContratoEmprestimo = null;

    #[ORM\Column(length: 4)]
    private int $anoContratoEmprestimo;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $numConvenio = null;

    #[ORM\Column(length: 4)]
    private int $anoConvenio;

    #[ORM\Column(length: 30)]
    private string $numNotaFiscal;

    #[ORM\Column(length: 10)]
    private int $dataNotaFiscal;

    #[ORM\Column(length: 10)]
    private int $dataAtesto;

    #[ORM\Column(length: 20)]
    private string $idPagamento;

    #[ORM\Column(length: 10)]
    private int $dataPagamento;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private string $valorPagamento;

    #[ORM\Column(length: 30)]
    private string $numContrato;

    #[ORM\Column(length: 4)]
    private string $anoContrato;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private string $valorContratacao;

    #[ORM\Column(length: 18)]
    private string $cpfCnpjCredor;

    #[ORM\Column(length: 2)]
    private string $tipoExigibilidade;

    #[ORM\Column(length: 254, nullable: true)]
    private ?string $justificativa = null;
}
