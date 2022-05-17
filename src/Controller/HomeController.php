<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManager;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Notification\ContactNotification;
use App\Repository\ParticipationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function home(ProjectRepository $part,Request $request): Response
    {
        
        
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->get('recherche')->getData();
            $ok = $part->getProjectByname($data);
        } else {
            $ok = $part->findAll();
        }

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'allevent' => $ok,
            'formRecherche' => $form->createView()
        ]);
    }


    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $rq, EntityManagerInterface $manager, ContactNotification $cn): Response
    {
        $contact =new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($rq);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setCreatedAt(new \DateTime());
            $manager->persist($contact);
            $manager->flush();
            $cn->notify($contact);
            $this->addFlash('success', "message envoyé avec succès !");
            return $this->redirectToRoute('home');
        }
        
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
            'formContact' => $form->createView()
            
        ]);
    }
    
}
