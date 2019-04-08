<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 07/04/2019
 * Time: 21:42
 */

namespace App\Controller;


use App\Entity\Voyage;
use App\Entity\VoyageUsager;
use App\Repository\UsagerRepository;
use App\Repository\VoyageRepository;
use App\Repository\VoyageUsagerRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class VoyageUserController extends  AbstractController
{
    public $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager=$objectManager;
    }

    /**
     * @Route("/reserver/{id}/{nbPlaces}",name ="voyageUser.reserver")
     * @param $id
     * @param Request $request
     * @param UsagerRepository $usagerRepository
     * @param VoyageRepository $voyageRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function reserver($id,$nbPlaces,Request $request,UsagerRepository $usagerRepository, VoyageRepository $voyageRepository){
        $nbreserv = $request->get('nombreReserv');
        $session = new Session();
        $idUsager= $session->get("id");
        $usager= $usagerRepository->find($idUsager);
        $voyage= $voyageRepository->find($id);
        $voyageUsager = new VoyageUsager();
        $intnbreserv= (integer)$nbreserv;
        $nbRestante = $nbPlaces - $intnbreserv;

        $voyageUsager
            ->setIdVoyage($voyage)
            ->setIdUsager($usager)
            ->setNbReservation($intnbreserv);
        $this->objectManager->persist($voyageUsager);
        $voyageRepository->updatePlaces($id,$nbRestante);
        $this->addFlash("success","Reservation effectuée");
        $this->objectManager->flush();
        return $this->render('pages/home.html.twig');
    }
}