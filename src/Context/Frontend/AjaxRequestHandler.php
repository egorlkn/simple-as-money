<?php

declare(strict_types=1);

namespace App\Context\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxRequestHandler extends AbstractController
{
    /**
     * @Route(path="calculator", methods={"GET"}, name="calculator")
     */
    public function calculatorAjax(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return new Response(Response::$statusTexts[Response::HTTP_NOT_ACCEPTABLE], Response::HTTP_NOT_ACCEPTABLE);
        }

        return new JsonResponse();
    }
}
