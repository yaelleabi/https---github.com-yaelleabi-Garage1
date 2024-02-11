<?php
// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class luckyController extends AbstractController
{
    #[Route('/', name: 'blog_list')]
    public function list(): Response
    {
        $number = rand(0, 100);
	
        return $this->render('base.html.twig', [
            'number' => $number,
        ]);    }
}