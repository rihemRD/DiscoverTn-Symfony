<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Service\pdfService;
use Ferrandini\Urlizer;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\Boolean;
use stdClass;
use Swift_Mailer;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;



class UtilisateurController extends AbstractController
{

    /**
     * @Route("/login", name="user_login" )
     */
    public function login(Request $request, \Swift_Mailer $mailer): Response
    {
        $session = $request->getSession();

        if ($session->has('user')) {
            $user1 = $this->getDataUserConnected($session);
            if ($user1->getRankUtilisateur() == "1") {

                return $this->redirectToRoute("UsersHome");
            }

        }
        $user = new Utilisateur();
        $form = $this->createFormBuilder($user)
            ->add('login_utilisateur', TextType::class)
            ->add('mdp_utilisateur', PasswordType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $pwd = $user->getMdpUtilisateur();
            $login = $user->getLoginUtilisateur();
            $rep = $this->getDoctrine()->getRepository(Utilisateur::class);

            $Existe = $rep->findOneBy(array('loginUtilisateur' => $login, 'mdpUtilisateur' => sha1($pwd)));

            if (!$Existe) {

                $this->get('session')->getFlashBag()->add('info', 'Erreur De Connexion : Votre Login Ou Mot De Passe Est Incorrect.');
            } else {
                $myObj = new stdClass();
                $myObj->Id = $Existe->getIdUtilisateur();
                $myObj->nom = $Existe->getNomUtilisateur();
                $myObj->prenom = $Existe->getPrenomUtilisateur();
                $myObj->email = $Existe->getEmailUtilisateur();
                $myObj->login = $Existe->getLoginUtilisateur();
                $myObj->rank = $Existe->getRankUtilisateur();
                $myObj->location = $Existe->getAdresseUtilisateur();
                $myObj->imgpath = $Existe->getImageUtilisateur();
                $myObj->tel = $Existe->getTelephoneUtilisateur();
                $myJSON = json_encode($myObj);
                $obj = json_decode($myJSON, true);
                $session->set('user', $obj);

                return $this->redirectToRoute("index_front");
            }
        }
        return $this->render('Front-Office/Utilisateur/login.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/signup", name="user_signup" , methods={"GET","POST"})
     */
    public function signup(Request $request, \Swift_Mailer $mailer): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $file = $request->files->get('utilisateur')['imageUtilisateur'];

            // $uploads_directory= $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                'C:/xampp/htdocs/devcomimgupload/', $filename
            );
            $user->setImageUtilisateur('C:/xampp/htdocs/devcomimgupload/' . $filename);

            $user->setRankUtilisateur(0);
            //  $captcha=$form->get('captchaCode')->getErrors();
            // $count=$captcha->count();


            $x = false;
            $y = false;
            if ($this->validLogin($user->getLoginUtilisateur())) {
                $x = true;
            } else
                $x = false;

            if ($this->validMail($user->getEmailUtilisateur())) {
                $y = true;
            } else {
                $y = false;
            }
            if (!filter_var($user->getEmailUtilisateur(), FILTER_VALIDATE_EMAIL)) {
                $this->get('session')->getFlashBag()->add('badmailformat', ' email est considérée comme invalide. ');
            } else if ($y == false) {
                $this->get('session')->getFlashBag()->add('badmail', 'email deja existe,vous pouvez utiliser  ');
            } else if ($x == false) {
                $this->get('session')->getFlashBag()->add('badlogin', 'login deja existe  ' . $this->generatedLogin($user->getNomUtilisateur()));
            } else {
                $hashPwd = sha1($user->getMdpUtilisateur());
                $user->setMdpUtilisateur($hashPwd);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                //$this->SendMailWelcome($user->getEmailUtilisateur(), $mailer);

                return $this->redirectToRoute("user_login");
            }

        }
        return $this->render("Front-Office/Utilisateur/signup.html.twig", ['form' => $form->createView()]);
    }

    public function getRank(SessionInterface $session): int
    {
        if ($session->has('user')) {
            $user = ($session->get('user'));
            $ar = json_encode($user);
            $aee = json_decode($ar);
            $data = (array)$aee;
            if ($aee->rank == "1") {
                return 1;
            }
        }
        return 0;
    }

    public function getDataUserConnected(SessionInterface $session): ?Utilisateur
    {
        $userConnected = new Utilisateur();
        if ($session->has('user')) {
            $user = ($session->get('user'));
            $ar = json_encode($user);
            $aee = json_decode($ar);
            $userConnected->setIdUtilisateur($aee->Id);
            $userConnected->setNomUtilisateur($aee->nom);
            $userConnected->setPrenomUtilisateur($aee->prenom);
            $userConnected->setEmailUtilisateur($aee->email);
            $userConnected->setLoginUtilisateur($aee->login);
            $userConnected->setRankUtilisateur($aee->rank);
            $userConnected->setAdresseUtilisateur($aee->location);
            $userConnected->setImageUtilisateur($aee->imgpath);
            $userConnected->setTelephoneUtilisateur($aee->tel);
        }

        return $userConnected;
    }




    /**
     * @Route("/FuserUpdate", name="FuserUpdate")
     */
    public function FuserUpdate(Request $request, SessionInterface $session): Response
    {
        $foo = $session->get('user');
        $user1 = $this->getDataUserConnected($session);
        $rep = $this->getDoctrine()->getRepository(Utilisateur::class);
        $Existe = $rep->findOneBy(array('loginUtilisateur' => $foo));
        $img=$Existe->getimageUtilisateur();
        $role=$Existe->getrankUtilisateur();
        $form = $this->createForm(UtilisateurType::class, $Existe);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $photo = $form->get('imageUtilisateur')->getData();

            if ($photo!=null)
            {
                $file = $request->files->get('utilisateur')['imageUtilisateur'];
                // $uploads_directory= $this->getParameter('uploads_directory');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move(
                    'C:/xampp/htdocs/devcomimgupload/', $filename
                );
                $Existe->setImageUtilisateur('C:/xampp/htdocs/devcomimgupload/' . $filename);
            }else
            {
                $Existe->setimageUtilisateur($img);
            }
            $Existe->setrankUtilisateur($role);
            $hashPwd = sha1($Existe->getMdpUtilisateur());
            $Existe->setMdpUtilisateur($hashPwd);
            $em = $this->getDoctrine()->getManager();
            $em->persist($Existe);
            $em->flush();
            return $this->redirectToRoute("index_front");
        }
        return $this->render("Front-Office/Utilisateur/modifierUser.html.twig", ['form' => $form->createView(),'user' => $user1]);
    }

    /**
     * @Route("/logout", name="user_logout" , methods={"GET","POST"})
     */
    public function logout(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute('user_login');
    }

    /**
     * @Route("/", name="")
     */
    public function home()
    {
        return $this->redirectToRoute('user_login');
    }

    /**
     * @Route("/Admin/AdminHome", name="UsersHome")
     */
    public function index(Request $request, PaginatorInterface $paginator, SessionInterface $session ): Response
    {

        $user = $this->getDataUserConnected($session);
        $data = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
        $users = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
20
        );
        return $this->render('Back-Office/Utilisateur/index.html.twig', [
            'users' => $users, 'user' => $user
        ]);
    }

    /**
     * @Route("/Admin/shownoadmins", name="shownoadmins")
     */
    public function shownoadmins(Request $request, PaginatorInterface $paginator, SessionInterface $session): Response
    {
        $user = $this->getDataUserConnected($session);
        $data = $this->getDoctrine()->getRepository(Utilisateur::class)->findBy(array('rankUtilisateur' => '0'));
        $users = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('Back-Office/Utilisateur/shownoadminsUsers.html.twig', [
            'users' => $users, 'user' => $user
        ]);
    }

    /**
     * @Route("/Admin/rankup{id}", name="rankup")
     */
    public function rankup(Request $request, PaginatorInterface $paginator, SessionInterface $session, $id): Response
    {
        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);
        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $user->setRankUtilisateur(1);
        $em->flush();
        return $this->redirectToRoute("shownoadmins");

        return $this->render('Back-Office/Utilisateur/shownoadminsUsers.html.twig', [
            'users' => $users, 'user' => $user
        ]);
    }



    /**
     * @Route("/userUpdate/{id}", name="userUpdate")
     */
    public function userUpdate(Request $request, $id, SessionInterface $session,UtilisateurRepository $utilisateurRepository): Response
    {

        $user1 = $this->getDataUserConnected($session);
        $user = $utilisateurRepository->find($id);
        $img = $user->getImageUtilisateur();
        $form = $this->createForm(UtilisateurType::class, $user);
        $form->remove("rankUtilisateur");
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $photo = $form->get('imageUtilisateur')->getData();
            if($photo!=null){
                $file = $request->files->get('utilisateur')['imageUtilisateur'];
                // $uploads_directory= $this->getParameter('uploads_directory');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move(
                    'C:/xampp/htdocs/devcomimgupload/', $filename
                );
                $user->setImageUtilisateur('C:/xampp/htdocs/devcomimgupload/' . $filename);
            }else{
                $user->setImageUtilisateur($img);
            }

            $hashPwd = sha1($user->getMdpUtilisateur());
            $user->setMdpUtilisateur($hashPwd);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("UsersHome");
        }
        return $this->render("Back-Office/Utilisateur/userUpdate.html.twig", ['form' => $form->createView(), 'user' => $user1]);
    }

    /**
     * @Route("/dropuser/{id}", name="dropuser")
     */
    public function dropuser(Utilisateur $user): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute("UsersHome");
    }



    /**
     * @Route("/indexFront", name="index_front")
     */
    public function indexFront(Request $request, PaginatorInterface $paginator, SessionInterface $session): Response
    {

        if ($session->has('user')) {
            $user = $this->getDataUserConnected($session);
            $data = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
            $users = $paginator->paginate(
                $data,
                $request->query->getInt('page', 1),
              20
            );


            if ($this->getRank($session) == 1) {
                return $this->render('Back-Office/Utilisateur/index.html.twig', [
                    'users' => $users, 'user' => $user
                ]);            } else {
                return $this->render('Front-Office/Utilisateur/accueil.html.twig', ['user' => $user]);
            }

        } else
            return $this->render('Front-Office/Utilisateur/login.html.twig');

    }

    private function validLogin(string $login): bool
    {
        $rep = $this->getDoctrine()->getRepository(Utilisateur::class);
        $Existe = $rep->findOneBy(array('loginUtilisateur' => $login));
        if (!$Existe) {
            return true;
        }
        return false;
    }

private function validMail(string $email) : bool
{
    $rep = $this->getDoctrine()->getRepository(Utilisateur::class);
    $Existe = $rep->findOneBy(array('emailUtilisateur' => $email));
    if (!$Existe) {
        return true;
    }
    return false;
}}