<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 07/04/2019
 * Time: 16:58
 */

namespace App\Controller;


use App\Entity\Voyage;
use App\Form\VoyageType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @property ObjectManager objectManager
 */
class VoyageController extends  AbstractController
{
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager=$objectManager;
    }

    /**
     * @Route( "/creerVoyage" , name="voyage.create")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response {
        $voyage = new Voyage();
        $form = $this->createForm(VoyageType::class,$voyage);
        $session = new Session();
        $id= $session->get("id");
        $form->add('idConducteur',null,[ 'data' =>$session->get("id")]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->persist($voyage);
            $this->objectManager->flush();
            $this->addFlash('success',"Voyage créé avec succés");
            return $this->render('pages/home.html.twig');
        }
        return $this->render('pages/creerVoyage.html.twig', [
            'form'=> $form->createView()
        ]);
    }
}