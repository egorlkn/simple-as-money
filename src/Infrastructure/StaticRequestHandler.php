<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticRequestHandler extends AbstractController
{
    /**
     * @Route(path="/", methods={"GET"}, name="homepage")
     */
    public function homepage(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            return new Response(Response::$statusTexts[Response::HTTP_NOT_ACCEPTABLE], Response::HTTP_NOT_ACCEPTABLE);
        }

        return $this->render('homepage.html.twig');
    }

    /**
     * @Route(path="/policy", methods={"GET"}, name="policy")
     */
    public function policy(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            return new Response(Response::$statusTexts[Response::HTTP_NOT_ACCEPTABLE], Response::HTTP_NOT_ACCEPTABLE);
        }

        return $this->render('policy.html.twig');
    }
}
