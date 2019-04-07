<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerLoginType;
use App\Repository\UsagerRepository;
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
     * @param Request $request
     * @return Response
     * @Route("/", name="usager.login")
     */
    public function index(){
        return $this->render('pages/login.html.twig');
    }
    /**
     * @param Request $request
     * @return Response
     * @Route("/", name="usager.login")
     */
    public function login(Request $request, UsagerRepository $usagerRepository){
        $pseudo = $request->get('pseudo');
        $mdp = $request->get('motdepasse');
        $result = $usagerRepository->findUserExist($pseudo,$mdp);
        if(empty($result)){
            return $this->render('pages/login.html.twig');
        }
        else return $this->render('pages/home.html.twig');
    }
    /**
     * @Route( "/signin" , name="usager.signin")
     * @param Request $request
     * @param ObjectManager $objectManager
     */
    public function new(Request $request): Response {
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