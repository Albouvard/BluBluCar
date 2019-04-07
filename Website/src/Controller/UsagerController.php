<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerLoginType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @property ObjectManager objectManager
 */
class UsagerController extends  AbstractController
{
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager=$objectManager;
    }

    /**
     * @Route( "/" , name="usager.signin")
     * @param Request $request
     * @param ObjectManager $objectManager
     */
    public function index(Request $request): Response {
        $Usager = new Usager();
        $form= $this->createForm(UsagerLoginType::class,$Usager);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->objectManager->persist($Usager);
            $this->objectManager->flush();
            return $this->redirectToRoute('home');

        }
        return $this->render('pages/signin.html.twig', [
            'form'=> $form->createView()
        ]);
    }

}