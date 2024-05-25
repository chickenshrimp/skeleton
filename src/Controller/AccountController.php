<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use http\Env;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends AbstractController
{
//    #[Route('/my-account', methods: ['GET'])]
//    public function index(Request $request, UsersRepository $usersRepository, EntityManagerInterface $entityManager)
//    {
//        $session = $request->getSession();
//        $user = $session->get('user');
//
//        if(isset($_POST["submitLogin"]))
//        {
//            $login = $_GET["current-login"];
//            echo $login;
//            $session = $request->getSession();
//            $user = $session->get('user');
//            if($user->login != $login && $login != '')
//            {
//                $userChange = $usersRepository->findOneBy(array($login))->setLogin($login);
//                $entityManager->flush();
//                echo $userChange->getLogin();
//                $entityManager->close();
//            }
//            return $this->render('account.html.twig', ['user' => $user]);
//        }
//        return $this->render('account.html.twig', ['user' => $user]);
//    }
}