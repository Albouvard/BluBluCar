<?php
/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 06/04/2019
 * Time: 21:02
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController
{


    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route ("/home",name="home")
     */
    public function index() : Response
    {
        return new Response($this->twig->render('pages/home.html.twig'));
    }
}