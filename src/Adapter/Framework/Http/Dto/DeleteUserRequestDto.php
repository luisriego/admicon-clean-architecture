<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto;

use Symfony\Component\HttpFoundation\Request;

class DeleteUserRequestDto implements RequestDto
{
    public readonly ?string $id;

    public function __construct(Request $request)
    {
        $this->id = $request->attributes->get('id');
    }
}