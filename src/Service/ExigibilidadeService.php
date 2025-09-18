<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Exigibilidade;
use App\Repository\Interface\ExigibilidadeRepositoryInterface;
use App\Service\Interface\ExigibilidadeServiceInterface;
use Symfony\Component\Serializer\SerializerInterface;

readonly class ExigibilidadeService implements ExigibilidadeServiceInterface
{
    public function __construct(
        private ExigibilidadeRepositoryInterface $repository,
        private SerializerInterface $serializer,
    ) {
    }

    public function create(array $data): Exigibilidade
    {
        $exigibilidade = $this->serializer->denormalize($data, Exigibilidade::class);

        return $this->repository->save($exigibilidade);
    }

    public function list(int $limit = 100, array $params = []): array
    {
        return $this->repository->findBy(
            $params,
            ['exercicio' => 'ASC'],
            $limit
        );
    }

    public function findBy(array $params = []): array
    {
        return $this->repository->findBy($params);
    }
}
