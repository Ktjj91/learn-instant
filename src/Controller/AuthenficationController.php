<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class AuthenficationController extends AbstractController
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private  readonly UserPasswordHasherInterface $passwordHasher,
        private readonly JWTTokenManagerInterface $tokenManager,
    )
    {
    }

    #[Route('/api/login/register', name: 'app.login.register', methods: ['POST'])]
    public function index(
        #[MapRequestPayload(serializationContext: ['groups' => 'user.create'])]User $user,
        EntityManagerInterface $entityManager): Response
    {

        $errors = $this->validator->validate($user);

        if($errors->count() > 0) {
            return $this->json([
                ['errors' => (string) $errors],
                Response::HTTP_BAD_REQUEST
            ]);
        }

        $hashed = $this->passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashed);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setRoles(['ROLE_USER']);

        $entityManager->persist($user);
        $entityManager->flush();

       $token =  $this->tokenManager->create($user);

        return $this->json(
           ['token' => $token],
            Response::HTTP_CREATED
        );
    }
}
