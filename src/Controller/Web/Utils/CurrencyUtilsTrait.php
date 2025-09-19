<?php

declare(strict_types=1);

namespace App\Controller\Web\Utils;

trait CurrencyUtilsTrait
{
    private function cleanCurrency(?string $value): ?string
    {
        return $value ? str_replace(',', '.', str_replace(['R$', ' ', '.'], '', $value)) : null;
    }
}
