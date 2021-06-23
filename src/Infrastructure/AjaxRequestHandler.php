<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxRequestHandler extends AbstractController
{
    /**
     * @Route(path="calculator/income", methods={"GET"}, name="calculator_income")
     */
    public function incomeCalculator(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return new Response(Response::$statusTexts[Response::HTTP_NOT_ACCEPTABLE], Response::HTTP_NOT_ACCEPTABLE);
        }

        return new JsonResponse();
    }

    /**
     * @Route(path="calculator/outcome", methods={"GET"}, name="calculator_outcome")
     */
    public function outcomeCalculator(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return new Response(Response::$statusTexts[Response::HTTP_NOT_ACCEPTABLE], Response::HTTP_NOT_ACCEPTABLE);
        }

        return new JsonResponse();
    }
}
