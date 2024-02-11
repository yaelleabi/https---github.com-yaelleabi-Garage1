<?php

namespace App\Controller;

use App\Entity\Review;
use DateTimeImmutable;
use App\Form\ReviewType;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewAddController extends AbstractController
{
    #[Route('/review/add', name: 'app_review_add')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        return $this->handleForm('review/add.html.twig', $request, $entityManager);
    }

    public function simplifiedForm(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        return $this->handleForm('review/base.html.twig', $request, $entityManager);
    }

    public function handleForm(
        string $template,
        Request $request,
        EntityManagerInterface $entityManager,
    ) {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review, [
            'action' => $this->generateUrl('app_review_add'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$form->get('note')->getData()) {
                $this->addFlash('alert', 'Vous devez sélectionner une note.');
                return $this->redirectToRoute('app_home');
            }
            $review->setNote((int) $form->get('note')->getData());
            $review->setSubmittedAt(new DateTimeImmutable());
            $review->setProcessed(false);
            $entityManager->persist($review);
            $entityManager->flush();
            $this->addFlash('success', 'Votre avis a bien été envoyé ! Nous le traiterons dans les meilleurs délais.');
            return $this->redirectToRoute('app_home');
        }

        return $this->render($template, ['reviewForm' => $form]);
    }
}
