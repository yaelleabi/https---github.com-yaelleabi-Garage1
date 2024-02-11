<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceDeleteController extends AbstractController
{
    #[Route('/config/service/delete/{id}', name: 'app_service_delete')]
    public function index(string $id, ServiceRepository $serviceRepository): Response
    {
        if ($serviceRepository->deleteServiceById($id)) {
            $this->addFlash('success', 'Le service a bien été supprimé !');
        } else {
            $this->addFlash('danger', 'Le service n\'a pas pu être supprimé !');
        }
        return $this->redirectToRoute('app_service_list');
    }
}
