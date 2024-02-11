<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewListController extends AbstractController
{
    #[Route('/config/review/list', name: 'app_review_list')]
    public function index(
        ReviewRepository $reviewRepository,
    ): Response {
        $reviews = $reviewRepository->findAll();

        return $this->render('review/list.html.twig', ['reviews' => $reviews]);
    }
}
