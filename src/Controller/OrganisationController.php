<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\OrganisateurType;
use App\Repository\UserRepository;
use Doctrine\Common\Util\Debug;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrganisationController extends AbstractController
{
    #[Route('/organisation', name: 'app_organisation')]
    public function index(EntityManagerInterface $manager, Request $rq, UserRepository $table): Response
    {
        $orga = new Demande;
        $form = $this->createForm(OrganisateurType::class, $orga);
        $form->handleRequest($rq);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser()->getUsername();
            $UserTable = $table->findOneBy([
                'email' => $user
            ]);
            $orga->setCreatedAt(new \DateTime());
            $orga->setUser($UserTable);
            $orga->setValidornot(false);
            $manager->persist($orga);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('organisation/index.html.twig', [
            'controller_name' => 'OrganisationController',
            'formDemande' => $form->createView()
        ]);
    }
}
