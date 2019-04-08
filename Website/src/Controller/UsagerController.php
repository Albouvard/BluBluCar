<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerLoginType;
use App\Repository\UsagerRepository;
use App\Repository\VoyageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use PhpParser\Error;
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
        $empty = true;
        $result = null;
        return $this->render('pages/search.html.twig', [
            'empty' => $empty,
            'result' => $result
        ]);
    }

    /**
     * @Route("/search_validation" , name="usager.valid_search")
     */
    public function rechercherValidation(Request $request, VoyageRepository $voyageRepository){
        $empty = false;
        $depart = $request->get('depart');
        $arrive = $request->get('arrive');
        $result = $voyageRepository->findByDepartArrive($depart, $arrive);
        if(empty($result)){
            $empty = true;
            $this->addFlash("Error","Aucun résultats");
        }
        return $this->render('pages/search.html.twig', [
            'empty' => $empty,
            'result' => $result
        ]);
    }

    /**
     * @Route("/contact", name="usager.contact")
     */
    public function contact(VoyageRepository $voyageRepository){
        $result = $voyageRepository->findById(9);
        $usager = $result[0]->getIdConducteur();
        return $this->render('pages/contact.html.twig', [
            'usager' => $usager
        ]);
    }

    private function sessionStart($pseudo, $id){
        $session = new Session();

        $session->set("id", $id);
        $session->set("pseudo",$pseudo);
    }

}