<?php

declare(strict_types=1);

namespace App\Service\Interface;

use App\Entity\Exigibilidade;

interface ExigibilidadeServiceInterface
{
    public function create(array $data): Exigibilidade;

    public function list(int $limit = 100, array $params = []): array;
}
