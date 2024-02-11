<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarAddType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarAddController extends AbstractController
{
    #[Route('/config/car/add', name: 'app_car_add')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        
    ): Response
    {
        $car = new Car();
        $form = $this->createForm(CarAddType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {;
            $entityManager->persist($car);
            $entityManager->flush();
            $this->addFlash('success', 'La voiture a bien été ajoutée !');
            return $this->redirectToRoute('app_car_list');
        }

        return $this->render('car/add.html.twig', [
            'form' => $form,
        ]);
    }
}
