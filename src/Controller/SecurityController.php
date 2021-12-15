<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController {

    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void {
        // controller can be blank: it will never be executed!
        //throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

    #[Route('/perfil', name: 'app_profile')]
    #[IsGranted('ROLE_USER')]
    public function profile(Request $request, UserPasswordHasherInterface $passwordEncoder, ManagerRegistry $doctrine) {
        /** @var User $user  */
        $user = $this->getUser();
        $form = $this->createFormBuilder($user)
            ->add('username')
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => false,
                'first_options' => [
                    'constraints' => [
                        new Length([
                            'min' => 6,
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => 'New password',
                ],
                'second_options' => [
                    'label' => 'Repeat Password',
                ],
                'invalid_message' => 'password.missmatch',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('plainPassword')->getData()) {
                // Encode the plain password, and set it.
                $encodedPassword = $passwordEncoder->hashPassword($user, $form->get('plainPassword')->getData());
                $user->setPassword($encodedPassword);
            }
            $doctrine->getManager()->flush();
            $this->addFlash('success', "Perfil Actualizado");
        }
        return $this->render('profile.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
