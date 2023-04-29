<?php

namespace App\Controller;

use App\Entity\ProfilUser;
use App\Form\UserPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * Ce controller permet de modifier l'email des utilisateur
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param ProfilUser $choosenUser
     * @return Response
     */
   #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    #[Route('/utilisateur/edition/{id}', name: 'user.edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $manager,
        ProfilUser $choosenUser,
        UserPasswordHasherInterface $hasher
    ): Response {
        // if (!$this->getUser()) {
        //     return $this->redirectToRoute('security.login');
        // }

        // if ($this->getUser() !== $user) {
        //     return $this->redirectToRoute('home.index');
        // }

        $form = $this->createForm(UserType::class, $choosenUser);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($choosenUser, $form->getData()->getPlainPassword())) {
                $user = $form->getData();

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Les informatons du compte ont bien été modifier.'
                );

                return $this->redirectToRoute('index.home');
            }
        } else {
            $this->addFlash(
                'warning',
                'Le mot de passe renseigné est incorrect'
            );
        }

        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Cette function sert a modifier le mot de passer de l'utilisateur.
     * @param ProfilUser $choosenUser
     * @param Request $request
     * @param  EntityManagerInterface $manager
     * @param   UserPasswordHasherInterface $hasher
     * @return Response
     */
   #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    #[Route('/utilisateur/edition-mot-de-passe/{id}', 'user.edit.password', methods: ['GET', 'POST'])]
    public function editPassword(
        ProfilUser $choosenUser,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher
    ): Response {
        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($choosenUser, $form->getData()['plainPassword'])) {
                $choosenUser->setUpdatedAt(new \DateTimeImmutable());
                $choosenUser->setPlainPassword(
                    $form->getData()['newPassword']
                );

                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié.'
                );

                $manager->persist($choosenUser);
                $manager->flush();

                return $this->redirectToRoute('index');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
            }
        }

        return $this->render('pages/user/edit_password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
