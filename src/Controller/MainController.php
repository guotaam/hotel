<?php

namespace App\Controller;
use App\Entity\Avis;
use App\Entity\Membre;
use App\Form\AvisType;
use App\Entity\Chambre;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\AvisRepository;
use App\Repository\ChambreRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ChambreRepository $repo): Response
    {
       // $chambres=$repo->findAll(); 
        return $this->render('main/index.html.twig', [
           
         //  'chambres'=>$chambres 
        ]);
      //  return $this->render('main/index.html.twig', [
         //   'controller_name' => 'MainController',
        //]);
    }

    #[Route('/home', name: 'app_show')]
    public function show(ChambreRepository $repo): Response
    {
        $chambres=$repo->findAll(); 
        return $this->render('main/home.html.twig', [
           
           'chambres'=>$chambres 
        ]);
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

#[Route('/main/resa/{id}', name: 'app_resa')]
public function resa(Chambre $chambre = null, EntityManagerInterface $manager, Request $rq)
{
    $commande = new Commande;
    $form = $this->createForm(CommandeType::class, $commande);
    $form->handleRequest($rq);

    if ($form->isSubmitted() && $form->isValid()) {
       // $commande->setMembre($this->getUser());
        $commande->setCreatedAt(new \DateTime());
        $commande->setChambre($chambre);

        $depart = $commande->getDateArrivee();
        if ($depart->diff($commande->getDateDepart())->invert == 1) {
            // si les dates sont incorrectes, recharge la page et affiche une erreur
            $this->addFlash('danger', 'Une période de temps ne peut pas être négative.');
            return $this->redirectToRoute('app_resa', [
                'id' => $chambre->getId()
            ]);
        }
        $jours = $depart->diff($commande->getDateDepart())->days;
        $prixTotal = ($commande->getChambre()->getPrixJournalier() * $jours) + $commande->getChambre()->getPrixJournalier();
        // récupère le prix total (sans la dernière addition, il manque un jour à payer)

        $commande->setPrixTotal($prixTotal);

        $manager->persist($commande);
        $manager->flush();
        $this->addFlash('success', 'Votre commande a bien été enregistrée !');
        return $this->renderForm('main/profil.html.twig');
    }

    return $this->renderForm('main/resa.html.twig', [
        'form' => $form,
        'cham' => $chambre
    ]);
}



#[Route('/main/menu', name: 'menu')]
public function menu(CommandeRepository $repo)
{
    

    return $this->render("main/menu.html.twig", [
        
    ]);
}

#[Route('/main/spa', name: 'spa')]
public function spa(CommandeRepository $repo)
{
    

    return $this->render("main/spa.html.twig", [
        
    ]);
}
  

#[Route('/main/contact', name: 'contact')]
public function contact(CommandeRepository $repo)
{
    
    $this->addFlash('success', 'Votre demande a bien été enregistrée !');
    return $this->render("main/contact.html.twig", [
        
    ]);
}

#[Route('/main/fiche', name: 'fiche')]
public function fiche(CommandeRepository $repo)
{
    
    
    return $this->render("main/fichesite.html.twig", [
        
    ]);
}


#[Route('/main/avis', name: 'avis')]
public function avis(AvisRepository $repo, Request $rq,EntityManagerInterface $manager)
{
    $avis = new Avis;
    $form = $this->createForm(AvisType::class, $avis);
    $form->handleRequest($rq);

    if ($form->isSubmitted() && $form->isValid()) {
       
       // $commande->setCreatedAt(new \DateTime());
        
        
        
    

        $manager->persist($avis);
        $manager->flush();
        $this->addFlash('success', 'Votre commentaire a bien été enregistrée !');
        return $this->renderForm('main/avis.html.twig');
    

    
}

return $this->renderForm('main/avis.html.twig',[
    'form' => $form
    
]);

   
}




}



