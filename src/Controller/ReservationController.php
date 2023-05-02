<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\HourlyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'reservation')]
    public function index(
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
        Request $request, 
        EntityManagerInterface $manager
        ): Response
    {

        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys =  $hourlyRepository->findBy([]);

       $reservation = new Reservation();
       $form = $this->createForm(ReservationType::class, $reservation);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($reservation);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre Réservation a bien été prise en compte'
        );
        return $this->redirectToRoute('index.home');
       }

        
        return $this->render('pages/reservation/reservation.html.twig', [
            'form' => $form->createView(),
            'hourlys' => $hourlys,
        ]);
    }
    
}
