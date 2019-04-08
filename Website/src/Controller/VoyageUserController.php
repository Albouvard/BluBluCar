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
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class VoyageUserController extends  AbstractController
{
    /**
     * @Route("/reserver",name ="voyageUser.reserver")
     * @param Voyage $voyage
     * @param Request $request
     * @param ObjectManager $objectManager
     */
    public function reserver(Voyage $voyage,Request $request,ObjectManager $objectManager){
        $nbreserv = $request->get('nbPlaces');
        $session = new Session();
        $idUsager= $session->get("id");
        $voyageUsager = new VoyageUsager();
        $idVoyage=$voyage->getId();
        $voyageUsager
            ->setIdVoyage($idVoyage)
            ->setIdUsager($idUsager)
            ->setNbReservation($nbreserv);
        $objectManager->persist($voyageUsager);
        $objectManager->flush();
        return $this->render('pages/home.html.twig');
    }
}