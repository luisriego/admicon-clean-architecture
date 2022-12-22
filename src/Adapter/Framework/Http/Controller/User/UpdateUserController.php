<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\User;

use App\Adapter\Framework\Http\Dto\UpdateUserRequestDto;
use App\Application\UseCase\User\UpdateUSer\Dto\UpdateUserInputDto;
use App\Application\UseCase\User\UpdateUSer\UpdateUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateUserController extends AbstractController
{
    public function __construct(private readonly UpdateUser $useCase)
    {
    }

    #[Route('/{id}', name: 'update_user', methods: ['PATCH'])]
    public function __invoke(UpdateUserRequestDto $request, string $id): Response
    {
        $inputDto = UpdateUserInputDto::create($id, $request->name, $request->email, $request->password, $request->age, $request->keys);

        $responseDto = $this->useCase->handle($inputDto);

        return $this->json($responseDto->userData);
    }
}
