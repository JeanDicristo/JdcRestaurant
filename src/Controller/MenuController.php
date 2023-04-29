<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\Menu;
use App\Entity\Formula;
use App\Entity\Category;
use App\Repository\DishRepository;
use App\Repository\MenuRepository;
use App\Repository\FormulaRepository;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'menu')]
    public function index(
        ManagerRegistry $doctrine,
        DishRepository $dishRepository,
        FormulaRepository $formulaRepository,
        CategoryRepository $categoryRepository,
        MenuRepository $menuRepository
        
    ): Response
    {
        $dishRepository = $doctrine->getRepository(Dish::class);
        $dishes = $dishRepository->findBy([]);

        $categoryRepository = $doctrine->getRepository(Category::class);
        $categorys = $categoryRepository->findBy([]);

        $formulaRepository = $doctrine->getRepository(Formula::class);
        $formulas = $formulaRepository->findBy([]);

        $menuRepository = $doctrine->getRepository(Menu::class);
        $menus = $menuRepository->findBy([]);

        return $this->render('pages/menu/menu.html.twig', [
            'dishes' => $dishes,
            'formulas' => $formulas,
            'menus' => $menus,
            'categorys' => $categorys,
        ]);
    }
}
