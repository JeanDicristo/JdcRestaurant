<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Repository\HourlyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FooterController extends AbstractController
{
    public function index(
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository
    ): Response
    {

        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBY([]);

        return $this->render('partials/_footer.html.twig', [
            'hourlys' => $hourlys,
        ]);
}
}
