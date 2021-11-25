<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Form\JeuType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JeuController extends AbstractController
{
    /**
     * @Route("/listJeu", name="listJeu")
     */
    public function listeJeu(): Response
    {
        //On récupére les jeux
        $listJeu = $this->getDoctrine()->getRepository(Jeu::class)->findAll();

        return $this->render('jeu/index.html.twig',[
            'listJeu' => $listJeu
        ]);
    }

    /**
     * @Route("/ajoutJeu", name="ajoutJeu")
     */
    public function ajoutJeu(Request $request): Response
    {
        //On créé une nouvelle instance de Jeu
        $jeu = new Jeu();

        //On créé le formulaire
        $form = $this->createForm(JeuType::class, $jeu);

        //On gère les réponses (si il a)
        $form->handleRequest($request);

        //Si le formulaire est correctement rempli
        if($form->isSubmitted() && $form->isValid()){
            //On le rajoute a la BDD
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($jeu);
            $manager->flush();

            //On signale que le jeu est enregistré
            $this->addFlash("success","Jeu enregistré");
        }

        return $this->render('jeu/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
