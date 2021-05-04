<?php

declare(strict_types=1);

namespace App\Context\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestHandler
{
    /**
     * @Route(path="/", name="homepage")
     */
    public function homepage(Request $request): Response
    {
        return new Response('Hello world!');
    }
}
