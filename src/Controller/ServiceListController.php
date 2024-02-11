<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceListController extends AbstractController
{
    #[Route('/config/service/list', name: 'app_service_list')]
    public function index(ServiceRepository $serviceRepository): Response
    {
        $services = $serviceRepository->findAllServices();
        
        return $this->render('service/list.html.twig', [
            'services' => $services
        ]);
    }
}
