<?php

declare(strict_types=1);

namespace App\Infrastructure\IncomeCalculator;

use App\Core\IncomeCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestHandler extends AbstractController
{
    private IncomeCalculator\Service $service;

    public function __construct(IncomeCalculator\Service $service)
    {
        $this->service = $service;
    }

    /**
     * @Route(path="/api/income-calculator", methods={"GET"}, name="api_income_calculator")
     */
    public function incomeCalculator(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return new Response(Response::$statusTexts[Response::HTTP_NOT_ACCEPTABLE], Response::HTTP_NOT_ACCEPTABLE);
        }

        $input = $this->mapRequestToInput($request);

        try {
            $result = $this->service->doCalculation($input);

            $presentation = Presentation::success($result);
        } catch (IncomeCalculator\Exception\CalculatorException $exception) {
            $presentation = Presentation::fail($exception);
        }

        return new JsonResponse($presentation->getView(), $presentation->getHttpCode());
    }

    private function mapRequestToInput(Request $request): IncomeCalculator\Model\Input
    {
        $initialAmount = $request->query->get('initial_amount');
        $regularPayment = $request->query->get('regular_payment');
        $numberOfRegularPaymentsPerYear = $request->query->get('number_of_regular_payments_per_year');
        $numberOfYears = $request->query->get('number_of_years');
        $interestRatePerYear = $request->query->get('interest_rate_per_year');
        $finalAmount = $request->query->get('final_amount');

        return new IncomeCalculator\Model\Input(
            isset($initialAmount) ? (float)$initialAmount : null,
            isset($regularPayment) ? (float)$regularPayment : null,
            (int)$numberOfRegularPaymentsPerYear,
            isset($numberOfYears) ? (float)$numberOfYears : null,
            isset($interestRatePerYear) ? (float)$interestRatePerYear : null,
            isset($finalAmount) ? (float)$finalAmount : null,
            (bool)$request->query->get('initial_amount_is_unknown', false),
            (bool)$request->query->get('regular_payment_is_unknown', false),
            (bool)$request->query->get('number_of_years_is_unknown', false),
            (bool)$request->query->get('interest_rate_per_year_is_unknown', false),
            (bool)$request->query->get('final_amount_is_unknown', false)
        );
    }
}
