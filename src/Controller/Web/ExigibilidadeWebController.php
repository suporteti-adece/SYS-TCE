<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Service\Interface\ExigibilidadeServiceInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class ExigibilidadeWebController extends AbstractController
{
    private const string LIST = 'list.html.twig';
    private const string CREATE = 'add.html.twig';

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
        if (false === $request->isMethod(Request::METHOD_POST)) {
            return $this->render(self::CREATE);
        }

        $errors = [];

        try {
            $cleanCurrency = function (?string $value): ?string {
                if (null === $value) {
                    return null;
                }
                $value = str_replace(['R$', ' ', '.'], '', $value);
                $value = str_replace(',', '.', $value);
                return is_numeric($value) ? $value : null;
            };

            $this->service->create([
                'id' => Uuid::v4(),
                'exercicio' => $request->get('exercicio'),
                'semestre' => $request->get('semestre'),
                'codFonteRecurso' => $request->get('codFonteRecurso'),
                'tipoRecurso' => $request->get('tipoRecurso'),
                'numContratoEmprestimo' => $request->get('numContratoEmprestimo') ?? null,
                'anoContratoEmprestimo' => $request->get('anoContratoEmprestimo'),
                'numConvenio' => $request->get('numConvenio') ?? null,
                'anoConvenio' => $request->get('anoConvenio'),
                'numNotaFiscal' => $request->get('numNotaFiscal'),
                'dataNotaFiscal' => $request->get('dataNotaFiscal'),
                'dataAtesto' => $request->get('dataAtesto'),
                'idPagamento' => $request->get('idPagamento'),
                'dataPagamento' => $request->get('dataPagamento'),
                'valorPagamento' => $cleanCurrency($request->get('valorPagamento')),
                'numContrato' => $request->get('numContrato'),
                'anoContrato' => $request->get('anoContrato'),
                'valorContratacao' => $cleanCurrency($request->get('valorContratacao')),
                'cpfCnpjCredor' => $request->get('cpfCnpjCredor'),
                'tipoExigibilidade' => $request->get('tipoExigibilidade'),
                'justificativa' => $request->get('justificativa') ?? null,
            ]);

            $this->addFlash('success', 'Exigibilidade cadastrada com sucesso!');
        } catch (Exception $exception) {
            $errors = [$exception->getMessage()];
        }

        if (false === empty($errors)) {
            return $this->render(self::CREATE, [
                'errors' => $errors,
            ]);
        }

        return $this->redirectToRoute('web_exigibilidade_list');
    }
}
