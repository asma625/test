<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//la route est valable juste pour la fonction au dessus de la quelle est taper et si on veut qu'il fonctionne pour tout faut la mettre au dessus de la classe
/**
 * @Route("/recette", name="recette.")
 */
class RecetteController extends AbstractController
{
    /**
     * @Route("/", name="editer")
     */
    public function index(RecetteRepository  $recetteRepository): Response
    {
        $recette = $recetteRepository->findAll();
        return $this->render('recette/index.html.twig', [
            'recette' => $recette,
        ]);
    }
    /**
     * @Route("/create", name="create")
     */

    public function create(Request $request){
        $recette = new Recette();
        $form = $this->createForm(RecetteType::class,$recette);
        $recette->setNom('Pizza');
        $recette->setDescription('coucou');
        $em = $this->getDoctrine()->getManager();
        $em->persist($recette);
        $em->flush();
        return $this->render('recette/create.html.twig', [
            'createForm' => $form->createView(),
        ]);

    }
}
