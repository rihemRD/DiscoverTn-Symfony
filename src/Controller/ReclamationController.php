<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Utilisateur;
use App\Form\ContactType;
use App\Form\ReclamationType;

use App\Repository\ReclamationRepository;
use ContainerNQMxs9H\getDebug_Security_Voter_VoteListenerService;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ReclamationController extends AbstractController
{

    /**
     * @Route("/indexreclamation", name="reclamation")
     */
    public function index(SessionInterface $session): Response
    {
        return $this->render('front/reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }

    /**
     * @Route("/display_reclamation", name="display_reclamation")
     */
    public function display_reclamation(Request $request, SessionInterface $session, PaginatorInterface $paginator): Response
    {
        $utilisateurController = new UtilisateurController();
        $user = $utilisateurController->getDataUserConnected($session);

        $data = $this->getDoctrine()->getRepository(Reclamation::class)->findAll();
        $evenements = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            50
        );
        /*
         *
          foreach ($evenements as $value) {
               if($value->getEtatReclamation()=="Pending");
               $evenementsPending=$value;
           }
   dd($evenementsPending); */
        return $this->render('Back-office/reclamation/index.html.twig', [
            'reclams' => $evenements, 'user' => $user
        ]);
    }

    /**
     * @Route("/reply_reclam/{id}", name="reply_reclam")
     */
    public function reply_reclam(Request $request, SessionInterface $session, $id, \Swift_Mailer $mailer): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        $rep = $this->getDoctrine()->getRepository(Reclamation::class);
        $Existe = $rep->findOneBy(array('idReclamation' => $id));
        if ($Existe) {
            $utilisateurController = new UtilisateurController();
            $admin = $utilisateurController->getDataUserConnected($session);
            $from = $admin->getNomUtilisateur() . ' ' . $admin->getPrenomUtilisateur();
            $to = $Existe->getEmailUtilisateur();
        }
        if ($form->isSubmitted()) {
            $Existe->setEtatReclamation("Replied");

            $datacontact = $form->get('body')->getData();
            $message = (new \Swift_Message('Support DiscoverTn'))
                ->setFrom('amine.zarrouk@esprit.tn')
                ->setTo($to)
                ->setBody('Bonjour ' . "\n" . '' . $datacontact);
            $mailer->send($message);
            $em = $this->getDoctrine()->getManager();
            $em->persist($Existe);
            $em->flush();
            return $this->redirectToRoute('display_reclamation');

        }
        return $this->render("Back-office/reclamation/replyreclamation.html.twig", ['form' => $form->createView(), 'to' => $to, 'user' => $admin]);
    }

    /**
     * @Route("/reclamation", name="AddReclamation")
     */
    public function AddReclamation(Request $request, SessionInterface $session): Response
    {
        $utilisateurController = new UtilisateurController();
        $idUser = $utilisateurController->getDataUserConnected($session)->getIdUtilisateur();
        $user1 = $this->getDoctrine()->getRepository(Utilisateur::class)->find($idUser);
        $user = ($session->get('user'));
        $ar = json_encode($user);
        $aee = json_decode($ar);
        $data = (array)$aee;
        $userEnv = $utilisateurController->getDataUserConnected($session);
        $Reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $Reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $Reclamation->setEmailUtilisateur($userEnv->getEmailUtilisateur());

            $Reclamation->setUtilisateur($user1);
            $Reclamation->setEtatReclamation('Pending');
            $Reclamation->setNomUtilisateur($userEnv->getNomUtilisateur());
            $Reclamation->setPrenomUtilisateur($userEnv->getPrenomUtilisateur());
            $em = $this->getDoctrine()->getManager();
            $em->persist($Reclamation);
            $em->flush();
            return $this->redirectToRoute('index_front');
            /*
             *
             *  $utilisateurController = new UtilisateurController($session);
                        $idUser= $utilisateurController->getDataUserConnected($session)->getIdUtilisateur();
                        $user=$this->getDoctrine()->getRepository(Utilisateur::class)->find($idUser);
                        $reservation->setIdUs($user);
             */
        }
        return $this->render('Front-office/reclamation/index.html.twig', [
            'form' => $form->createView(), 'user' => $data,
        ]);
    }

    /**
     * @Route("/destroy_reclam/{id}", name="destroy_reclam")
     */
    public function destroy_reclam(Request $request, $id, ReclamationRepository $reclamationRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $reclamationRepository->find($id);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('display_reclamation');
    }

}
