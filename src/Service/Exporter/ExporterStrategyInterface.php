<?php
// src/Service/Exporter/ExporterStrategyInterface.php

namespace App\Service\Exporter;

use Symfony\Component\HttpFoundation\Response;

interface ExporterStrategyInterface
{

    public function export(array $data, array $params = []): Response;
    
    public function supports(string $format): bool;
}
