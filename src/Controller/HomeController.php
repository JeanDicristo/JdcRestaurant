<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Hourly;
use App\Repository\DishRepository;
use App\Repository\PhotoRepository;
use App\Repository\HourlyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'index', methods:['GET'])]
    public function index(
        ManagerRegistry $doctrine,
        PhotoRepository $photoRepository,
        HourlyRepository $hourlyRepository,
    ): Response {

        
        $photoRepository = $doctrine->getRepository(Photo::class);
        $photos = $photoRepository->findBy([]); // Récupéréer uniquement 3 PLats ...   FindAll() Récuperer tout les plat

        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBY([]);
        
    

        return $this->render('pages/home/index.html.twig', [
            'photo' => $photos,
            'hourlys' => $hourlys,
        ]);
    }
}
