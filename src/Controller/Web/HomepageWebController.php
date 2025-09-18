<?php

declare(strict_types=1);

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomepageWebController extends AbstractController
{
    public function homepage(): Response
    {
        return $this->redirectToRoute('web_exigibilidade_list');
    }
}
