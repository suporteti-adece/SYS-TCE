<?php

declare(strict_types=1);

namespace App\Service\Exporter;

use DOMDocument;
use Symfony\Component\HttpFoundation\Response;

class XmlExporterStrategy implements ExporterStrategyInterface
{
    private string $codEnte;
    private string $nomeEnte;
    private string $nomeGestor;
    private string $cpfGestor;
    private string $nomeContador;
    private string $crcContador;

    // O construtor para injetar os dados fixos continua o mesmo
    public function __construct(
        string $codEnte,
        string $nomeEnte,
        string $nomeGestor,
        string $cpfGestor,
        string $nomeContador,
        string $crcContador
    ) {
        $this->codEnte = $codEnte;
        $this->nomeEnte = $nomeEnte;
        $this->nomeGestor = $nomeGestor;
        $this->cpfGestor = $cpfGestor;
        $this->nomeContador = $nomeContador;
        $this->crcContador = $crcContador;
    }

    /**
     * Documentação: O método 'export' agora aceita os parâmetros de filtro.
     * @param array $exigibilidades Os dados filtrados a serem exportados.
     * @param array $params Os filtros ('exercicio', 'semestre') vindos do controller.
     */
    public function export(array $exigibilidades, array $params = []): Response
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;

        $remessa = $dom->createElement('REMESSA');
        $dom->appendChild($remessa);

        // Pega o ano e o semestre dos parâmetros recebidos
        $anoRemessa = $params['exercicio'] ?? date('Y');
        $semestreRemessa = str_pad($params['semestre'] ?? '1', 2, '0', STR_PAD_LEFT);

        // Usa os dados injetados (fixos) e os parâmetros de filtro (dinâmicos)
        $cabecalho = $dom->createElement('CABECALHO');
        $cabecalho->appendChild($dom->createElement('COD_ENTE', $this->codEnte));
        $cabecalho->appendChild($dom->createElement('NOME_ENTE', $this->nomeEnte));
        $cabecalho->appendChild($dom->createElement('ANO_REMESSA', $anoRemessa));
        $cabecalho->appendChild($dom->createElement('SEMESTRE_REMESSA', $semestreRemessa));
        $remessa->appendChild($cabecalho);

        // Esta parte continua igual, iterando sobre os dados já filtrados
        foreach ($exigibilidades as $exigibilidade) {
            $item = $dom->createElement('EXIGIBILIDADE');
            $item->appendChild($dom->createElement('NUM_LEI', $exigibilidade->getNumeroLei()));
            $item->appendChild($dom->createElement('DATA_LEI', $exigibilidade->getDataLei()->format('dmY')));
            $item->appendChild($dom->createElement('DATA_PUBLICACAO_LEI', $exigibilidade->getDataPublicacaoLei()->format('dmY')));
            $item->appendChild($dom->createElement('DESCRICAO', $exigibilidade->getDescricao()));
            $item->appendChild($dom->createElement('VALOR', number_format($exigibilidade->getValor(), 2, ',', '')));
            $item->appendChild($dom->createElement('DATA_VENCIMENTO', $exigibilidade->getDataVencimento()->format('dmY')));
            $remessa->appendChild($item);
        }

        // Rodapé com dados injetados
        $rodape = $dom->createElement('RODAPE');
        $rodape->appendChild($dom->createElement('NOME_GESTOR', $this->nomeGestor));
        $rodape->appendChild($dom->createElement('CPF_GESTOR', $this->cpfGestor));
        $rodape->appendChild($dom->createElement('NOME_CONTADOR', $this->nomeContador));
        $rodape->appendChild($dom->createElement('CRC_CONTADOR', $this->crcContador));
        $remessa->appendChild($rodape);

        $xmlContent = $dom->saveXML();

        // Gera o nome do arquivo dinamicamente com base nos filtros
        $fileName = sprintf('END_%s_%s_%s.xml', $this->codEnte, $anoRemessa, $semestreRemessa);

        $response = new Response($xmlContent);
        $response->headers->set('Content-Type', 'application/xml');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        return $response;
    }

    public function supports(string $format): bool
    {
        return strtolower($format) === 'xml';
    }
}
