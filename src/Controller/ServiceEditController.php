<?php

namespace App\Controller;

use App\Form\ServiceAddType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceEditController extends AbstractController
{
    #[Route('/config/service/edit/{id}', name: 'app_service_edit')]
    public function index(
        string $id,
        Request $request,
        EntityManagerInterface $entityManager,
        ServiceRepository $serviceRepository
    ): Response {
        $service = $serviceRepository->findServiceById($id);
        $form = $this->createForm(ServiceAddType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($service);
            $entityManager->flush();
            $this->addFlash('success', 'Le service a bien été modifié !');
            return $this->redirectToRoute('app_service_list');
        }

        return $this->render('service/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
