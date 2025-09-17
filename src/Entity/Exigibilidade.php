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

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): void
    {
        $this->id = $id;
    }

    public function getExercicio(): int
    {
        return $this->exercicio;
    }

    public function setExercicio(int $exercicio): void
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

    public function getCodOrgao(): string
    {
        return $this->codOrgao;
    }

    public function setCodOrgao(string $codOrgao): void
    {
        $this->codOrgao = $codOrgao;
    }

    public function getCodFonteRecurso(): string
    {
        return $this->codFonteRecurso;
    }

    public function setCodFonteRecurso(string $codFonteRecurso): void
    {
        $this->codFonteRecurso = $codFonteRecurso;
    }

    public function getTipoRecurso(): string
    {
        return $this->tipoRecurso;
    }

    public function setTipoRecurso(string $tipoRecurso): void
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

    public function getAnoContratoEmprestimo(): int
    {
        return $this->anoContratoEmprestimo;
    }

    public function setAnoContratoEmprestimo(int $anoContratoEmprestimo): void
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

    public function getAnoConvenio(): int
    {
        return $this->anoConvenio;
    }

    public function setAnoConvenio(int $anoConvenio): void
    {
        $this->anoConvenio = $anoConvenio;
    }

    public function getNumNotaFiscal(): string
    {
        return $this->numNotaFiscal;
    }

    public function setNumNotaFiscal(string $numNotaFiscal): void
    {
        $this->numNotaFiscal = $numNotaFiscal;
    }

    public function getDataNotaFiscal(): int
    {
        return $this->dataNotaFiscal;
    }

    public function setDataNotaFiscal(int $dataNotaFiscal): void
    {
        $this->dataNotaFiscal = $dataNotaFiscal;
    }

    public function getDataAtesto(): int
    {
        return $this->dataAtesto;
    }

    public function setDataAtesto(int $dataAtesto): void
    {
        $this->dataAtesto = $dataAtesto;
    }

    public function getIdPagamento(): string
    {
        return $this->idPagamento;
    }

    public function setIdPagamento(string $idPagamento): void
    {
        $this->idPagamento = $idPagamento;
    }

    public function getDataPagamento(): int
    {
        return $this->dataPagamento;
    }

    public function setDataPagamento(int $dataPagamento): void
    {
        $this->dataPagamento = $dataPagamento;
    }

    public function getValorPagamento(): string
    {
        return $this->valorPagamento;
    }

    public function setValorPagamento(string $valorPagamento): void
    {
        $this->valorPagamento = $valorPagamento;
    }

    public function getNumContrato(): string
    {
        return $this->numContrato;
    }

    public function setNumContrato(string $numContrato): void
    {
        $this->numContrato = $numContrato;
    }

    public function getAnoContrato(): string
    {
        return $this->anoContrato;
    }

    public function setAnoContrato(string $anoContrato): void
    {
        $this->anoContrato = $anoContrato;
    }

    public function getValorContratacao(): string
    {
        return $this->valorContratacao;
    }

    public function setValorContratacao(string $valorContratacao): void
    {
        $this->valorContratacao = $valorContratacao;
    }

    public function getCpfCnpjCredor(): string
    {
        return $this->cpfCnpjCredor;
    }

    public function setCpfCnpjCredor(string $cpfCnpjCredor): void
    {
        $this->cpfCnpjCredor = $cpfCnpjCredor;
    }

    public function getTipoExigibilidade(): string
    {
        return $this->tipoExigibilidade;
    }

    public function setTipoExigibilidade(string $tipoExigibilidade): void
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
