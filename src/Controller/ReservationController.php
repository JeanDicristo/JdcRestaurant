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
use Symfony\Component\HttpFoundation\JsonResponse;

class ReservationController extends AbstractController
{
#[Route('/verifier_disponibilite_tables', name: 'verifier_disponibilite_tables', methods: ['POST'])]
public function verifierDisponibiliteTables(Request $request): JsonResponse
{
    try {
        // Récupération des paramètres envoyés par la requête AJAX
        $date = $request->request->get('date');
        $hour = $request->request->get('hour');

        // Vérification de la disponibilité des tables à la date et heure spécifiées
        $tablesDisponibles = true; 

        // Création de la réponse JSON
        $response = new JsonResponse([
            'disponible' => $tablesDisponibles,
        ]);
    } catch (\Exception $e) {
        // En cas d'erreur, renvoyer un message d'erreur dans la réponse JSON
        $response = new JsonResponse([
            'error' => $e->getMessage(),
        ], 500);
    }

    return $response;
}
    #[Route('/reservation', name: 'reservation')]
    public function index(
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
    
        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys =  $hourlyRepository->findBy([]);
    
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            //Vérification du nombre total de convivespour ce jour qui na pas été dépasser
            $reservationRepository = $manager->getRepository(Reservation::class);
            $totalGuests = $reservationRepository->countGuestsForDate($reservation->getDate());
            $maxGuests = 50;
    
            if ($totalGuests + $reservation->getGuest() > $maxGuests) {
                $this->addFlash('danger', 'Le nombre maximum de convives pour ce jour a été atteint.');
                return $this->redirectToRoute('reservation');
            }
    
            $manager->persist($reservation);
            $manager->flush();
    
            $this->addFlash(
                'success',
                'Votre Réservation a bien été prise en compte'
            );
            return $this->redirectToRoute('index');
        }
    
        // retourner la vue de formulaire de réservation si le formulaire n'est pas soumis ou n'est pas valide
        return $this->render('pages/reservation/reservation.html.twig', [
            'form' => $form->createView(),
            'hourlys' => $hourlys,
            'reservationForm' => $form, // Ajout de la variable de formulaire de réservation
        ]);
    }
}
