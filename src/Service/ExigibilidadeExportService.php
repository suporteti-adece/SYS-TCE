<?php

declare(strict_types=1);

namespace App\Service;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class ExigibilidadeExportService
{
    private iterable $strategies;

    public function __construct(iterable $strategies)
    {
        $this->strategies = $strategies;
    }

    public function export(string $format, array $data, array $params = []): Response
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($format)) {
                return $strategy->export($data, $params);
            }
        }

        throw new InvalidArgumentException("Formato de exportação '{$format}' não suportado.");
    }
}
