<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;


class LoginController  extends AbstractController
{
    #[Route('/login1', name: 'app_login')]
    public function loginCheckUser(Request $request): Response
    {
        //$email = "ss"; // Récupérer l'e-mail à partir de la requête
        $password = $request->request->get('password');

        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['email' =>$request->request->get('email2')]);
        
        if ($user) {
            if ($user->getPassword() == $password) {
                $session = $request->getSession();
               // $session->set('email', $email);
              //  $session->set('id', $user->getId());
                return $this->redirectToRoute('app_admin_index');
            } else {
                return $this->redirectToRoute('app_invalidpass');
            }
        } else {
            return $this->redirectToRoute('app_invalidpass');
        }
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

}
