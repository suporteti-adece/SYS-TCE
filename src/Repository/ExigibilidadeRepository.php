<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Exigibilidade;
use App\Repository\Interface\ExigibilidadeRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class ExigibilidadeRepository extends AbstractRepository implements ExigibilidadeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exigibilidade::class);
    }

    public function save(Exigibilidade $exigibilidade): Exigibilidade
    {
        $this->getEntityManager()->persist($exigibilidade);
        $this->getEntityManager()->flush();

        return $exigibilidade;
    }

    public function remove(Exigibilidade $exigibilidade): void
    {
        $this->getEntityManager()->remove($exigibilidade);
        $this->getEntityManager()->flush();
    }
}
