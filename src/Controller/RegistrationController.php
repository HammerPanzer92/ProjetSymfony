<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    //l'encoder de Mdp
    private $passwordEncoder;

    //On récupére l'encodeur utilisé par Symfony
    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function index(Request $request): Response
    {
        //On créé une nouvelle instance de User
        $user = new User();

        //On créé le formulaire
        $form = $this->createForm(UserType::class, $user);

        //On gére la requête
        $form->handleRequest($request);

        //Si le formulaire est correctement rempli
        if($form->isSubmitted() && $form->isValid()){
            //On enregistre le mot de passe (hashé via Symfony)
            $user->setPassword($this->passwordEncoder->hashPassword($user, $user->getPassword()));

            //On lui défini le role de base
            $user->setRoles(["ROLE_USER"]);

            //On l'enregistre dans la BDD
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            $this->addFlash("success","Vous êtes enregistrés");

            //On le renvoi vers la page de login
            $this->redirectToRoute("app_login");
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
