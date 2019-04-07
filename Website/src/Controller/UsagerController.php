<?php

namespace App\Controller;

use App\Form\UsagerLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsagerController extends  AbstractController
{
    /**
     * @Route( "/" , name="usager.login")
     * @return Response
     */
    public function index(): Response {
        $form= $this->createForm(UsagerLoginType::class);
        return $this->render('pages/signin.html.twig',[
            'form'=> $form->createView()
        ]);
    }

}