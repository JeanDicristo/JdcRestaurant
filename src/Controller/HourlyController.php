<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Repository\HourlyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HourlyController extends AbstractController
{
    #[Route('/hourly', name: 'hourly')]
    public function index(
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository
    ): Response
    {

        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBy([]);

        return $this->render('partials/hourly.html.twig', [
            'hourlys' => $hourlys,
        ]);
    }
}
