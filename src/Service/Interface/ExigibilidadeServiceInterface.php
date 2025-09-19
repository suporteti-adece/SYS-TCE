<?php

declare(strict_types=1);

namespace App\Service\Interface;

use App\Entity\Exigibilidade;
use Symfony\Component\Uid\Uuid;

interface ExigibilidadeServiceInterface
{
    public function create(array $data): Exigibilidade;

    public function list(int $limit = 100, array $params = []): array;

    public function findBy(array $params): array;

    public function findOneBy(array $array): ?Exigibilidade;

    public function get(Uuid $id): ?Exigibilidade;

    public function update(Exigibilidade $exigibilidade, array $data): Exigibilidade;
}
