<?php

declare(strict_types=1);

namespace App\Infrastructure\SpendCalculator;

use App\Core\SpendCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestHandler extends AbstractController
{
    private SpendCalculator\Service $service;

    public function __construct(SpendCalculator\Service $service)
    {
        $this->service = $service;
    }

    /**
     * @Route(path="/api/spend-calculator", methods={"GET"}, name="api_spend_calculator")
     */
    public function SpendCalculator(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return new Response(Response::$statusTexts[Response::HTTP_NOT_ACCEPTABLE], Response::HTTP_NOT_ACCEPTABLE);
        }

        $input = $this->mapRequestToInput($request);

        try {
            $result = $this->service->doCalculation($input);

            $presentation = Presentation::success($result);
        } catch (SpendCalculator\Exception\CalculatorException $exception) {
            $presentation = Presentation::fail($exception);
        }

        return new JsonResponse($presentation->getView(), $presentation->getHttpCode());
    }

    private function mapRequestToInput(Request $request): SpendCalculator\Model\Input
    {
        $initialAmount = $request->query->get('initial_amount');
        $paymentAmount = $request->query->get('payment_amount');
        $numberOfPaymentsPerYear = $request->query->get('number_of_payments_per_year');
        $numberOfYears = $request->query->get('number_of_years');
        $interestRatePerYear = $request->query->get('interest_rate_per_year');
        $finalAmount = $request->query->get('final_amount');
        $numberOfYearsUntilFistPayment = $request->query->get('number_of_years_until_fist_payment');
        $inflation = $request->query->get('inflation');

        return new SpendCalculator\Model\Input(
            isset($initialAmount) ? (float)$initialAmount : null,
            isset($paymentAmount) ? (float)$paymentAmount : null,
            (int)$numberOfPaymentsPerYear,
            isset($numberOfYears) ? (float)$numberOfYears : null,
            isset($interestRatePerYear) ? (float)$interestRatePerYear : null,
            isset($finalAmount) ? (float)$finalAmount : null,
            (float)$numberOfYearsUntilFistPayment,
            (float)$inflation,
            (bool)$request->query->get('initial_amount_is_unknown', false),
            (bool)$request->query->get('payment_amount_is_unknown', false),
            (bool)$request->query->get('number_of_years_is_unknown', false),
            (bool)$request->query->get('interest_rate_per_year_is_unknown', false),
            (bool)$request->query->get('final_amount_is_unknown', false)
        );
    }
}
