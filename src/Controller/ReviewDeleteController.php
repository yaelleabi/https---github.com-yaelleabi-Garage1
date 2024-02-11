<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewDeleteController extends AbstractController
{
    #[Route('/config/review/delete/{id}', name: 'app_review_delete')]
    public function index(string $id, ReviewRepository $reviewRepository): Response
    {
        if ($reviewRepository->deleteReviewById($id)) {
            $this->addFlash('success', 'L\'avis a bien été supprimé !');
        } else {
            $this->addFlash('danger', 'L\'avis n\'a pas pu être supprimé !');
        }
        return $this->redirectToRoute('app_review_list');
    }
}
