<?php

namespace App\Controller;

use App\Entity\Test;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(): Response
    {    
        //Récupére le gestionnaire des objets de type "Test"
        $em = $this->getDoctrine()->getRepository(Test::class);

        //Renvoi tout les tests stockés dans la BDD
        $listTest = $em->findAll();
        return $this->render('acceuil/index.html.twig', [
            'tabTest' => $listTest,
        ]);
    }
}
