<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        return $this->handleForm('contact/index.html.twig', $request, $entityManager);
    }

    public function simplifiedForm(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        return $this->handleForm('contact/base.html.twig', $request, $entityManager);
    }

    public function formWithPrefilledSubject(
        string $subject,
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        $request->query->set('subject', $subject);
        return $this->handleForm('contact/base.html.twig', $request, $entityManager);
    }

    public function handleForm(
        string $template,
        Request $request,
        EntityManagerInterface $entityManager,
    ) {
        $contact = new Contact();
        if ($request->query->has('subject')) {
            $contact->setSubject($request->query->get('subject'));
        }
        $form = $this->createForm(ContactType::class, $contact, [
            'action' => $this->generateUrl('app_contact'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {;
            $contact->setSubmittedAt(new DateTimeImmutable());
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render($template, ['contactForm' => $form]);
    }
}
