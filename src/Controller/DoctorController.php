<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/doctor', name: 'app_doctor')]
class DoctorController extends AbstractController
{
    #[Route('/', name: 'app_doctor_info')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DoctorController.php',
        ]);
    }

    #[Route('/{doctor_name}', name: 'app_doctor_hello')]
    public function hello_doctor($doctor_name): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!'.$doctor_name,
            'path' => 'src/Controller/DoctorController.php',
        ]);
    }
}
