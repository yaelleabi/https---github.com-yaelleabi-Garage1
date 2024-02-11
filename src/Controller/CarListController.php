<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarAddType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarListController extends AbstractController
{
    #[Route('/car/list', name: 'app_car_list')]
    public function index(
        CarRepository $carRepository,
        Request $request

    ): Response {

        // Get filters
        $filters = $request->query->all();

        // check if we have filters
        if (empty($filters)) {
            $cars = $carRepository->findAll();
            return $this->render('car/list.html.twig', ['cars' => $cars]);
        }

        // We have priceInf, priceSup, yearInf, yearSup, kmInf, kmSup
        // We need to transform them into price, year, km
        // We need to remove empty values

        $filters = array_filter($filters, function ($value) {
            return $value !== '';
        });
        // $filters = ["priceInf" => 1000, "priceSup" => 2000, "yearInf" => 2010, "yearSup" => 2015, "kmInf" => 10000, "kmSup" => 20000]
        // transform to filters = ["name"] => {"inf" => 1000, "sup" => 2000}
        // transform to filters = ["year"] => {"inf" => 2010, "sup" => 2015}
        // transform to filters = ["km"] => {"inf" => 10000, "sup" => 20000}
        // filters = ["price" => {"inf" => 1000, "sup" => 2000}, "year" => {"inf" => 2010, "sup" => 2015}, "km" => {"inf" => 10000, "sup" => 20000}]
        $filters = array_reduce(array_keys($filters), function ($acc, $key) use ($filters) {
            if (strpos($key, 'Inf') !== false) {
                $newKey = str_replace('Inf', '', $key);
                $acc[$newKey]['inf'] = $filters[$key];
            } else if (strpos($key, 'Sup') !== false) {
                $newKey = str_replace('Sup', '', $key);
                $acc[$newKey]['sup'] = $filters[$key];
            }
            return $acc;
        }, []);

        
        // Get cars
        $cars = $carRepository->findByFilters($filters);

        return $this->render('car/list.html.twig', [
            'cars' => $cars
        ]);
    }
}
