<?php

declare(strict_types=1);

namespace App\Service\Exporter;

use App\Entity\Exigibilidade;
use DateTime;
use Symfony\Component\HttpFoundation\Response;

class XmlExporterStrategy implements ExporterStrategyInterface
{
    public function export(array $data, array $params = []): Response
    {
        $exercicio = $params['exercicio'] ?? date('Y');
        $semestre = str_pad($params['semestre'] ?? '1', 2, '0', STR_PAD_LEFT);
        $codOrgao = !empty($data) ? $data[0]->getCodOrgao() : '';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<oce>' . PHP_EOL;
        $xml .= "    <exercicio>{$exercicio}</exercicio>" . PHP_EOL;
        $xml .= "    <semestre>{$semestre}</semestre>" . PHP_EOL;
        $xml .= "    <codOrgao>{$codOrgao}</codOrgao>" . PHP_EOL;
        $xml .= '    <exigibilidades>' . PHP_EOL;

        /** @var Exigibilidade $exigibilidade */
        foreach ($data as $exigibilidade) {
            $xml .= '        <exigibilidade>' . PHP_EOL;

            $xml .= $this->createNode('codFonteRecurso', $exigibilidade->getCodFonteRecurso());
            $xml .= $this->createNode('tipoRecurso', $exigibilidade->getTipoRecurso());
            $xml .= $this->createNode('numContratoEmprestimo', $exigibilidade->getNumContratoEmprestimo());
            $xml .= $this->createNode('anoContratoEmprestimo', $exigibilidade->getAnoContratoEmprestimo());
            $xml .= $this->createNode('numConvenio', $exigibilidade->getNumConvenio());
            $xml .= $this->createNode('anoConvenio', $exigibilidade->getAnoConvenio());
            $xml .= $this->createNode('numNotaFiscal', $exigibilidade->getNumNotaFiscal());
            $xml .= $this->createNode('dataNotaFiscal', $this->formatDate($exigibilidade->getDataNotaFiscal()));
            $xml .= $this->createNode('dataAtesto', $this->formatDate($exigibilidade->getDataAtesto()));
            $xml .= $this->createNode('idPagamento', $exigibilidade->getIdPagamento());
            $xml .= $this->createNode('dataPagamento', $this->formatDate($exigibilidade->getDataPagamento()));
            $xml .= $this->createNode('valorPagamento', $this->formatCurrency($exigibilidade->getValorPagamento()));
            $xml .= $this->createNode('numContrato', $exigibilidade->getNumContrato());
            $xml .= $this->createNode('anoContrato', $exigibilidade->getAnoContrato());
            $xml .= $this->createNode('valorContratacao', $this->formatCurrency($exigibilidade->getValorContratacao()));
            $xml .= $this->createNode('cpfCnpjCredor', $exigibilidade->getCpfCnpjCredor());
            $xml .= $this->createNode('tipoExigibilidade', $exigibilidade->getTipoExigibilidade());
            $xml .= $this->createNode('justificativa', $exigibilidade->getJustificativa());

            $xml .= '        </exigibilidade>' . PHP_EOL;
        }

        $xml .= '    </exigibilidades>' . PHP_EOL;
        $xml .= '</oce>' . PHP_EOL;

        $fileName = sprintf('END_%s_%s_%s.xml', $codOrgao, $exercicio, $semestre);

        $response = new Response($xml);
        $response->headers->set('Content-Type', 'application/xml');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        return $response;
    }

    public function supports(string $format): bool
    {
        return strtolower($format) === 'xml';
    }

    private function createNode(string $tagName, ?string $value): string
    {
        $escapedValue = htmlspecialchars($value ?? '', ENT_XML1, 'UTF-8');
        return "            <{$tagName}>{$escapedValue}</{$tagName}>" . PHP_EOL;
    }

    private function formatDate(?string $date): string
    {
        if (empty($date)) {
            return '';
        }
        return (new DateTime($date))->format('d/m/Y');
    }

    private function formatCurrency(?string $value): string
    {
        if (empty($value)) {
            return '0,00';
        }
        return number_format((float) $value, 2, ',', '');
    }
}
