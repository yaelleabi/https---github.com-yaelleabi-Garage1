<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewCheckController extends AbstractController
{
    #[Route('/config/review/check/{id}', name: 'app_review_check')]
    public function index(
        string $id,
        ReviewRepository $reviewRepository,
    ): Response {
        $reviews = $reviewRepository->processReviewById($id);
        $this->addFlash('success', 'L\'avis a bien été traité.');
        return $this->redirectToRoute('app_review_list');
    }
}
