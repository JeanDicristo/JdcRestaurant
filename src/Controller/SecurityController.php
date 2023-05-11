<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Entity\ProfilUser;
use App\Form\RegistrationType;
use App\Repository\HourlyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'security.login', methods: ['GET', 'POST'])]
    public function login(
        AuthenticationUtils $authenticationUtils,
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
        ): Response
    {
        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBY([]);

        return $this->render('pages/security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'hourlys' => $hourlys,
        ]);
    }

    /**
     *  Ce contrôleur nous permet de nous déconnecter
     *
     * @return void
     */
    #[Route('/deconnexion', 'security.logout')]
    public function logout()
    {
        // Rien a faire ici 
    }

    /**
     *  Ce contrôleur nous permet de nous enregistré
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    
    #[Route('/inscription', 'security.registration',  methods: ['GET', 'POST'])]
    public function registration(
        Request $request, 
        EntityManagerInterface $manager,
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
        ): Response
    {
        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBY([]);

        $user = new ProfilUser();
        $user->setRoles(['ROLES_USER']);
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $this->addFlash(
                'success',
                'Votre compte a bien été créer'
            );

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security.login');
        }

        return $this->render('pages/security/registration.html.twig', [
            'form' => $form->createView(),
            'hourlys' => $hourlys,
        ]);
    }
}
