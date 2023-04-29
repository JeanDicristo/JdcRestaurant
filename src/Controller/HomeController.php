<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Repository\DishRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        ManagerRegistry $doctrine,
        DishRepository $dishRepository
    ): Response {
        $dishRepository = $doctrine->getRepository(Dish::class);
        $dishs = $dishRepository->findBY([]);
        $imageNames = array();
        foreach ($dishs as $dish) {
            $imageNames[] = $dish->getImageName();
        }

        return $this->render('pages/home/index.html.twig', [
            'dishs' => $dishs,
            'imageNames' => $imageNames,
        ]);
    }
}
