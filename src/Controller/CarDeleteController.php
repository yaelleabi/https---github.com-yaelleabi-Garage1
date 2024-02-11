<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarDeleteController extends AbstractController
{
    #[Route('/config/car/delete/{id}', name: 'app_car_delete')]
    public function index(string $id, CarRepository $carRepository): Response
    {
        if ($carRepository->deleteById($id)) {
            $this->addFlash('success', 'La voiture a bien été supprimée !');
        } else {
            $this->addFlash('danger', 'La voiture n\'a pas pu être supprimée !');
        }
        return $this->redirectToRoute('app_car_list');
    }
}
