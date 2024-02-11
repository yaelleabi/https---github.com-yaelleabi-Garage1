<?php
namespace App\Twig;

use App\Repository\OpeningHourRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $openingHoursRepository;

    public function __construct(OpeningHourRepository $openingHoursRepository)
    {
        $this->openingHoursRepository = $openingHoursRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_opening_hours', [$this, 'getOpeningHours']),
        ];
    }

    public function getOpeningHours()
    {
        return $this->openingHoursRepository->findAll();
    }
}