<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarAddType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarEditController extends AbstractController
{
    #[Route('/config/car/edit/{id}', name: 'app_car_edit')]
    public function index(
        string $id,
        Request $request,
        EntityManagerInterface $entityManager,
        CarRepository $carRepository
    ): Response
    {
        $car = new Car();
        $car = $carRepository->find($id);
        $form = $this->createForm(CarAddType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {;
            $entityManager->persist($car);
            $entityManager->flush();
            $this->addFlash('success', 'La voiture a bien été mise à jour !');
            return $this->redirectToRoute('app_car_list');
        }

        return $this->render('car/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
