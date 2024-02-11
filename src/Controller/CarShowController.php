<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarShowController extends AbstractController
{
    #[Route('/cars/{id}', name: 'app_car_show')]
    public function index(
        String $id,
        CarRepository $carRepository
    ): Response {
        $car = $carRepository->find($id);
        return $this->render('car/show.html.twig', [
            'car' => $car
        ]);
    }
}
