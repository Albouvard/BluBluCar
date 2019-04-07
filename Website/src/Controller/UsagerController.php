<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerLoginType;
use App\Repository\UsagerRepository;
use App\Repository\VoyageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
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
     * @Route("/", name="usager.index")
     */
    public function index(){
        $session = new Session();
        $session->clear();
        return $this->render('pages/login.html.twig');
    }
    /**
     * @param Request $request
     * @return Response
     * @Route("/login", name="usager.login")
     */
    public function login(Request $request, UsagerRepository $usagerRepository){
        $pseudo = $request->get('pseudo');
        $mdp = $request->get('motdepasse');
        $result = $usagerRepository->findUserExist($pseudo,$mdp);
        if(empty($result)){
            return $this->render('pages/login.html.twig');
        }
        $id = $result[0]->getId();
        $this->sessionStart($pseudo,$id);
        return $this->redirectToRoute('home');
    }
    /**
     * @Route( "/signin" , name="usager.signin")
     * @param Request $request
     * @param ObjectManager $objectManager
     */
    public function new(Request $request): Response {
        $Usager = new Usager();
        $form = $this->createForm(UsagerLoginType::class,$Usager);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->persist($Usager);
            $this->objectManager->flush();
            return $this->render('pages/login.html.twig');
        }
        return $this->render('pages/signin.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/search" , name="usager.search")
     */
    public function rechercherVoyage(){
        return $this->render('pages/search.html.twig');
    }

    /**
     * @Route("/search_validation" , name="usager.valid_search")
     */
    public function rechercherValidation(Request $request, VoyageRepository $voyageRepository){
        $depart = $request->get('depart');
        $arrive = $request->get('arrive');
        $result = $voyageRepository->findByDepartArrive($depart, $arrive);
        if(empty($result)){
            return $this->redirectToRoute('usager.search');
        }
        foreach ($result as $value){
            echo $value->getVilleDepart();
            echo $value->getVilleArrive();
        }
        return $this->redirectToRoute('usager.search');
    }

    private function sessionStart($pseudo, $id){
        $session = new Session();

        $session->set("id", $id);
        $session->set("pseudo",$pseudo);
    }

}