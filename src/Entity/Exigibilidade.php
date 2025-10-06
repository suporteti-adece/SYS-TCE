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
    private string $exercicio;

    #[ORM\Column(length: 2)]
    private string $semestre;

    #[ORM\Column(length: 6)]
    private int $codOrgao = 480301;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $codFonteRecurso = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $tipoRecurso = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $numContratoEmprestimo = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $anoContratoEmprestimo = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $numConvenio = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $anoConvenio = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $numNotaFiscal = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $dataNotaFiscal = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $dataAtesto = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $idPagamento = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $dataPagamento = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 2, nullable: true)]
    private ?string $valorPagamento = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $numContrato = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $anoContrato = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 2, nullable: true)]
    private ?string $valorContratacao = null;

    #[ORM\Column(length: 18, nullable: true)]
    private ?string $cpfCnpjCredor = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $razaoSocial = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $tipoExigibilidade = null;

    #[ORM\Column(length: 254, nullable: true)]
    private ?string $justificativa = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): void
    {
        $this->id = $id;
    }

    public function getExercicio(): string
    {
        return $this->exercicio;
    }

    public function setExercicio(string $exercicio): void
    {
        $this->exercicio = $exercicio;
    }

    public function getSemestre(): string
    {
        return $this->semestre;
    }

    public function setSemestre(string $semestre): void
    {
        $this->semestre = $semestre;
    }

    public function getCodOrgao(): int
    {
        return $this->codOrgao;
    }

    public function setCodOrgao(int $codOrgao): void
    {
        $this->codOrgao = $codOrgao;
    }

    public function getCodFonteRecurso(): ?string
    {
        return $this->codFonteRecurso;
    }

    public function setCodFonteRecurso(?string $codFonteRecurso): void
    {
        $this->codFonteRecurso = $codFonteRecurso;
    }

    public function getTipoRecurso(): ?string
    {
        return $this->tipoRecurso;
    }

    public function setTipoRecurso(?string $tipoRecurso): void
    {
        $this->tipoRecurso = $tipoRecurso;
    }

    public function getNumContratoEmprestimo(): ?string
    {
        return $this->numContratoEmprestimo;
    }

    public function setNumContratoEmprestimo(?string $numContratoEmprestimo): void
    {
        $this->numContratoEmprestimo = $numContratoEmprestimo;
    }

    public function getAnoContratoEmprestimo(): ?string
    {
        return $this->anoContratoEmprestimo;
    }

    public function setAnoContratoEmprestimo(?string $anoContratoEmprestimo): void
    {
        $this->anoContratoEmprestimo = $anoContratoEmprestimo;
    }

    public function getNumConvenio(): ?string
    {
        return $this->numConvenio;
    }

    public function setNumConvenio(?string $numConvenio): void
    {
        $this->numConvenio = $numConvenio;
    }

    public function getAnoConvenio(): ?string
    {
        return $this->anoConvenio;
    }

    public function setAnoConvenio(?string $anoConvenio): void
    {
        $this->anoConvenio = $anoConvenio;
    }

    public function getNumNotaFiscal(): ?string
    {
        return $this->numNotaFiscal;
    }

    public function setNumNotaFiscal(?string $numNotaFiscal): void
    {
        $this->numNotaFiscal = $numNotaFiscal;
    }

    public function getDataNotaFiscal(): ?string
    {
        return $this->dataNotaFiscal;
    }

    public function setDataNotaFiscal(?string $dataNotaFiscal): void
    {
        $this->dataNotaFiscal = $dataNotaFiscal;
    }

    public function getDataAtesto(): ?string
    {
        return $this->dataAtesto;
    }

    public function setDataAtesto(?string $dataAtesto): void
    {
        $this->dataAtesto = $dataAtesto;
    }

    public function getIdPagamento(): ?string
    {
        return $this->idPagamento;
    }

    public function setIdPagamento(?string $idPagamento): void
    {
        $this->idPagamento = $idPagamento;
    }

    public function getDataPagamento(): ?string
    {
        return $this->dataPagamento;
    }

    public function setDataPagamento(?string $dataPagamento): void
    {
        $this->dataPagamento = $dataPagamento;
    }

    public function getValorPagamento(): ?string
    {
        return $this->valorPagamento;
    }

    public function setValorPagamento(?string $valorPagamento): void
    {
        $this->valorPagamento = $valorPagamento;
    }

    public function getNumContrato(): ?string
    {
        return $this->numContrato;
    }

    public function setNumContrato(?string $numContrato): void
    {
        $this->numContrato = $numContrato;
    }

    public function getAnoContrato(): ?string
    {
        return $this->anoContrato;
    }

    public function setAnoContrato(?string $anoContrato): void
    {
        $this->anoContrato = $anoContrato;
    }

    public function getValorContratacao(): ?string
    {
        return $this->valorContratacao;
    }

    public function setValorContratacao(?string $valorContratacao): void
    {
        $this->valorContratacao = $valorContratacao;
    }

    public function getCpfCnpjCredor(): ?string
    {
        return $this->cpfCnpjCredor;
    }

    public function getRazaoSocial(): ?string
    {
        return $this->razaoSocial;
    }

    public function setRazaoSocial(?string $razaoSocial): void
    {
        $this->razaoSocial = $razaoSocial;
    }

    public function setCpfCnpjCredor(?string $cpfCnpjCredor): void
    {
        $this->cpfCnpjCredor = $cpfCnpjCredor;
    }

    public function getTipoExigibilidade(): ?string
    {
        return $this->tipoExigibilidade;
    }

    public function setTipoExigibilidade(?string $tipoExigibilidade): void
    {
        $this->tipoExigibilidade = $tipoExigibilidade;
    }

    public function getJustificativa(): ?string
    {
        return $this->justificativa;
    }

    public function setJustificativa(?string $justificativa): void
    {
        $this->justificativa = $justificativa;
    }
}
