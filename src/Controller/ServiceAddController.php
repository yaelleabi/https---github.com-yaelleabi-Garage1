<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceAddType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceAddController extends AbstractController
{
    #[Route('/config/service/add', name: 'app_service_add')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        $service = new Service();
        $form = $this->createForm(ServiceAddType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($service);
            $entityManager->flush();
            $this->addFlash('success', 'Le service a bien été créé !');
            return $this->redirectToRoute('app_service_list');
        }

        return $this->render('service/add.html.twig', [
            'form' => $form,
        ]);
    }
}
