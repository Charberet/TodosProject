<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{
    #[Route('/{_locale}', name: 'app_home')]
    public function index(Request $request): Response
    {
        $locale = $request->getLocale();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'locale'=>$locale,
        ]);
    }

   
}
