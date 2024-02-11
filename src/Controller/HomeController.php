<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\ReviewRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ServiceRepository $serviceRepository,
        CarRepository $carRepository,
        ReviewRepository $reviewRepository,
    ): Response {
        $services = $serviceRepository->findAllServices();
        $cars = $carRepository->findBy([], ['id' => 'DESC'], 3);
        $reviews = $reviewRepository->findBy(['processed' => true], ['note' => 'DESC'], 5);

        return $this->render('home/index.html.twig', [
            'services' => $services,
            'cars' => $cars,
            'reviews' => $reviews,
        ]);
    }
}
