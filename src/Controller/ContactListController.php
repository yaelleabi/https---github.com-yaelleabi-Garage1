<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactListController extends AbstractController
{
    #[Route('/config/contact/', name: 'app_contact_list')]
    public function index(
        ContactRepository $contactRepository,
    ): Response
    {

        $contacts = $contactRepository->findAll();
        return $this->render('contact/list.html.twig', [
            'contacts' => $contacts,
        ]);
    }
}
