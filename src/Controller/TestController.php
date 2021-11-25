<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Entity\Test;
use App\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/Test/{id}", name="Test")
     */
    public function Test(int $id): Response
    {
        //Récupére un test (via son id passé via l'adresse)
        $test = $this->getDoctrine()->getRepository(Test::class)->find($id);

        return $this->render('test/affichage.html.twig', [
            "Test" => $test
        ]);
    }


    /**
     * @Route("/redactionTest/{id}", name="redactionTest")
     */
    public function redactionTest(int $id,Request $request): Response
    //On rajoute l'id du jeu dans l'adresse, et on la récupére via un paramètre
    {
        //On créé un nouvel objet "Test"
        $test = new Test();

        //On créé le formulaire
        $form = $this->createForm(TestType::class, $test);

        //On gére la requête
        $form->handleRequest($request);

        //Si le formulaire a été rempli
        if ($form->isSubmitted() && $form->isValid()) {
            //On récupére l'utilisateur
            $test->setIdTesteur($this->getUser());

            //On récupére le jeu (via l'id récupéré sur l'adresse)
            $test->setIdJeu($this->getDoctrine()->getRepository(Jeu::class)->find($id));

            //On le rajoute a la BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush();

            //On signale qu'on a rajouté
            $this->addFlash("success", "Test enregistré");

            //On renvoie vers l'acceuil
            $this->redirectToRoute("acceuil");
        }

        return $this->render('test/redaction.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
