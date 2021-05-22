<?php

declare(strict_types=1);

namespace App\Context\Frontend;

use App\Context\Backend\Calculator;
use App\Context\Frontend\Forms\CalculatorInputForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestHandler extends AbstractController
{
    private Calculator\Service $calcService;

    public function __construct(Calculator\Service $calcService)
    {
        $this->calcService = $calcService;
    }

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

    /**
     * @Route(path="/calculator", methods={"GET", "POST"}, name="calculator")
     */
    public function calculator(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            return new Response(Response::$statusTexts[Response::HTTP_NOT_ACCEPTABLE], Response::HTTP_NOT_ACCEPTABLE);
        }

        $form = $this->createForm(CalculatorInputForm::class, Calculator\Model\Input::empty());

        if (!$request->isMethod(Request::METHOD_POST)) {
            return $this->render('calculator.html.twig', ['form' => $form->createView()]);
        }

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('calculator.html.twig', ['form' => $form->createView()]);
        }

        $calcInput = $form->getData();

        try {
            $result = $this->calcService->doCalculation($calcInput);
        } catch (Calculator\Exception\CalculatorException $e) {
            $result = null;
            $error = new FormError($e->getMessage());

            $form->addError($error);
        }

        return $this->render(
            'calculator.html.twig',
            [
                'form' => $form->createView(),
                'result' => $result,
            ]
        );
    }

    /**
     * @Route(path="/api/v1/calculator", methods={"GET"}, name="calculatorApiV1")
     */
    public function calculatorAjax(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return new Response(Response::$statusTexts[Response::HTTP_NOT_ACCEPTABLE], Response::HTTP_NOT_ACCEPTABLE);
        }

        return new JsonResponse();
    }
}
