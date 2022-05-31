<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'root')]
    public function root(): Response
    {
        return $this->redirectToRoute('gast_home_page');
    }

    #[Route('/home', name: 'gast_home_page')]
    public function gastHomePage(): Response
    {
        return $this->render('home/GastHomePage.html.twig', [
            'test'=>'Testing from gast Home Page',
        ]);
    }


}
