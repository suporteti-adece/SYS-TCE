<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Controller\Web\Utils\CurrencyUtilsTrait;
use App\Service\ExigibilidadeExportService;
use App\Service\Interface\ExigibilidadeServiceInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class ExigibilidadeWebController extends AbstractController
{
    use CurrencyUtilsTrait;

    private const string LIST = 'list.html.twig';
    private const string CREATE = 'add.html.twig';
    private const string EDIT = 'edit.html.twig';

    public function __construct(
        private readonly ExigibilidadeServiceInterface $service,
    ) {
    }

    public function list(): Response
    {
        $exigibilidades = $this->service->list();

        return $this->render(self::LIST, [
            'exigibilidades' => $exigibilidades,
        ]);
    }

    public function create(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            try {
                $data = $request->request->all();
                $data['id'] = Uuid::v4();

                $data['valorPagamento'] = $this->cleanCurrency($data['valorPagamento'] ?? null);
                $data['valorContratacao'] = $this->cleanCurrency($data['valorContratacao'] ?? null);

                $this->service->create($data);

                $this->addFlash('success', 'Exigibilidade cadastrada com sucesso!');

                return $this->redirectToRoute('web_exigibilidade_list');
            } catch (Exception $exception) {
                $this->addFlash('error', 'Erro ao cadastrar exigibilidade: '.$exception->getMessage());
            }
        }

        return $this->render(self::CREATE);
    }

    public function exportXml(Request $request, ExigibilidadeExportService $exportService): Response
    {
        $exercicio = $request->query->get('exercicio');
        $semestre = $request->query->get('semestre');

        if (empty($exercicio) || empty($semestre)) {
            $this->addFlash('warning', 'Para exportar, por favor, selecione um Exercício e um Semestre.');

            return $this->redirectToRoute('web_exigibilidade_list');
        }

        $filters = [
            'exercicio' => $exercicio,
            'semestre' => $semestre,
        ];

        $exigibilidades = $this->service->findBy($filters);

        return $exportService->export('xml', $exigibilidades, $filters);
    }

    public function edit(Request $request, string $id): Response
    {
        try {
            $exigibilidade = $this->service->get(Uuid::fromString($id));
        } catch (Exception $exception) {
            $this->addFlash('error', $exception->getMessage());

            return $this->redirectToRoute('web_exigibilidade_list');
        }

        if ($request->isMethod(Request::METHOD_POST)) {
            try {
                $dataToUpdate = $request->request->all();

                $dataToUpdate['valorPagamento'] = $this->cleanCurrency($dataToUpdate['valorPagamento'] ?? null);
                $dataToUpdate['valorContratacao'] = $this->cleanCurrency($dataToUpdate['valorContratacao'] ?? null);

                $this->service->update($exigibilidade, $dataToUpdate);

                $this->addFlash('success', 'Exigibilidade atualizada com sucesso!');

                return $this->redirectToRoute('web_exigibilidade_list');
            } catch (Exception $exception) {
                $this->addFlash('error', 'Erro ao atualizar exigibilidade: ' . $exception->getMessage());
            }
        }

        return $this->render(self::EDIT, [
            'exigibilidade' => $exigibilidade,
        ]);
    }

}
