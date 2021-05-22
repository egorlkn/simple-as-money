<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\Model;

use JsonSerializable;

class Result implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [];
    }
}
