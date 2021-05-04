<?php

declare(strict_types=1);

namespace App\Context\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestHandler extends AbstractController
{
    /**
     * @Route(path="/", name="homepage")
     */
    public function homepage(Request $request): Response
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route(path="/policy", name="policy")
     */
    public function policy(Request $request): Response
    {
        return $this->render('policy.html.twig');
    }
}
