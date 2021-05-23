<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\Model;

use JsonSerializable;

class Result implements JsonSerializable
{
    private string $strategy;

    public function __construct(string $strategy)
    {
        $this->strategy = $strategy;
    }

    public function jsonSerialize(): array
    {
        return [
            $this->strategy,
        ];
    }
}
