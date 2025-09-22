<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Exigibilidade;
use App\Repository\Interface\ExigibilidadeRepositoryInterface;
use App\Service\Interface\ExigibilidadeServiceInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Uid\Uuid;

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
        $filteredParams = array_filter($params, function ($value) {
            return null !== $value && '' !== $value;
        });

        return $this->repository->findBy($filteredParams);
    }

    public function findOneBy(array $array): ?Exigibilidade
    {
        return $this->repository->findOneBy($array);
    }

    public function get(Uuid $id): ?Exigibilidade
    {
        $exigibilidade = $this->findOneBy(['id' => $id]);

        if (null === $exigibilidade) {
            throw new ResourceNotFoundException('Exigibilidade not found');
        }

        return $exigibilidade;
    }

    public function update(Exigibilidade $exigibilidade, array $data): Exigibilidade
    {
        $this->serializer->denormalize($data, Exigibilidade::class, 'array', ['object_to_populate' => $exigibilidade]);

        return $this->repository->save($exigibilidade);
    }

    public function remove(Uuid $id): void
    {
        $exigibilidade = $this->findOneBy(['id' => $id]);

        if (null === $exigibilidade) {
            throw new ResourceNotFoundException('Exigibilidade not found');
        }

        $this->repository->remove($exigibilidade);
    }
}
