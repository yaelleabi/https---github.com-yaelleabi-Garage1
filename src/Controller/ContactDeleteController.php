<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactDeleteController extends AbstractController
{
    #[Route('/config/contact/delete/{id}', name: 'app_contact_delete')]
    public function index(
        int $id,
        ContactRepository $contactRepository,

    ): Response {
        if ($contactRepository->deleteById($id)) {
            $this->addFlash('success', 'Le message a bien été supprimé !');
        } else {
            $this->addFlash('danger', 'Le message n\'a pas pu être supprimé !');
        }
        return $this->redirectToRoute('app_contact_list');
    }
}
