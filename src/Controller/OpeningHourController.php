<?php

namespace App\Controller;


use App\Repository\OpeningHourRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class OpeningHourController extends AbstractController
{
    #[Route('/admin/opening_hours', name: 'app_opening_hour')]
    public function index(
        OpeningHourRepository $openingHoursRepository,
        Request $request,
    ): Response {
        $openingHours = $openingHoursRepository->findAll();
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $openingHoursRepository->batchUpdate($data);
            $this->addFlash('success', 'Horaires mis à jour');
            return $this->redirectToRoute('app_opening_hour');
        }
        return $this->render('openinghour.html.twig', [
            'openingHours' => $openingHours,
        ]);
    }
}
