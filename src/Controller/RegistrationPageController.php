<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Env;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RegistrationPageController extends AbstractController
{
    #[Route('/registration')]
    public function index(EntityManagerInterface $entityManager, UsersRepository $usersRepository, Request $request)
    {
        if(isset($_POST["submit"]))
        {
            $login = $_POST["login"];
            $password = $_POST["password"];
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $user = $usersRepository->findOneBy(array('login' => $login));
            if($user != null){
                return $this->render('exception.html.twig', ['exception' => 'такой логин уже есть']);
            }
            else if($login && $password && $name && $surname)
            {
                $addUser = new Users();
                $addUser->setName($name);
                $addUser->setSurname($surname);
                $addUser->setLogin($login);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $addUser->setPassword($hashedPassword);
                $addUser->setAdminRole(false);
                $addUser->setHasAbilityForShop(false);
                $entityManager->persist($addUser);
                $entityManager->flush();
                $entityManager->close();

                $session = $request->getSession();
                $session->set('user', $user);
                return $this->redirectToRoute('account');
            }
        }
        return $this->render('registration.html.twig');
    }
}