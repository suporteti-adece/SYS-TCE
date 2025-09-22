<?php

declare(strict_types=1);

namespace App\Repository\Interface;

use App\Entity\Exigibilidade;

interface ExigibilidadeRepositoryInterface
{
    public function save(Exigibilidade $exigibilidade): Exigibilidade;

    public function remove(Exigibilidade $exigibilidade): void;
}
