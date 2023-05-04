<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\HourlyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    private function getTimeSlots(\DateTime $date): array
{
    $start_time = new \DateTime('10:00');
    $end_time = new \DateTime('21:30');
    $interval = new \DateInterval('PT30M');
    $time_slots = [];

    $current_time = clone $start_time;
    while ($current_time <= $end_time) {
        $time_slots[] = $current_time->format('H:i');
        $current_time = $current_time->add($interval);
    }

    return $time_slots;
}

    #[Route('/check-availability', name: 'app_check_availability', methods: ['POST'])]
    public function checkAvailability(
        Request $request,
        ManagerRegistry $doctrine,
        )
    {
        
        $date = new \DateTime($request->request->get('date'));
        $guests = (int) $request->request->get('guests');
        $time_slots = $this->getTimeSlots($date);        // Créer une méthode pour générer les horaires de réservation disponibles pour cette date

        $reservations = $this->$doctrine()->getRepository(Reservation::class)->findBy(['date' => $date]);

        $total_guests = 0;
        foreach ($reservations as $reservation) {
            $total_guests += $reservation->getGuests();
        }

        $available_time_slots = [];
        foreach ($time_slots as $time_slot) {
            if ($total_guests + $guests <= $this->getParameter('max_guests')) {
                $available_time_slots[] = $time_slot;
            }
        }

        return new JsonResponse(['available_time_slots' => $available_time_slots]);
    }

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
        return $this->redirectToRoute('index');
       }

        
        return $this->render('pages/reservation/reservation.html.twig', [
            'form' => $form->createView(),
            'hourlys' => $hourlys,
        ]);
    }
    
}
