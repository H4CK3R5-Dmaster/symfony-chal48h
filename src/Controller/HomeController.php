<?php

namespace App\Controller;

use App\Repository\ParticipationRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/home', name: 'home')]
    public function home(ParticipationRepository $part): Response
    {
        
        $ok = $part->findAll();
        

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'allevent' => $ok
        ]);
    }


    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }
    
}
