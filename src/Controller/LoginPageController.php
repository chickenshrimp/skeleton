<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\Goods;
use App\Entity\Shops;
use App\Entity\Users;
use App\Repository\BasketRepository;
use App\Repository\GoodsRepository;
use App\Repository\ShopsRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Curl\User;
use http\Env;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LoginPageController extends AbstractController
{
    #[Route('/login', name: 'login_page')]
    public function loginPage(Request $request, UsersRepository $usersRepository)
    {
        session_start();
        if(isset($_POST["submit"]) and isset($_POST["login"]) and isset($_POST["password"]))
        {
            $login = $_POST["login"];
            $password = $_POST["password"];
            $user = $usersRepository->findOneBy(array('login' => $login));
            if($user && password_verify($password, $user->getPassword())){
                $session = $request->getSession();
                $session->set('user', $user);
                return $this->redirectToRoute('account');
            }
            else
            {
                return $this->render('exception.html.twig', ['exception' => 'неправильные данные']);
            }
        }
        return $this->render('login.html.twig');
    }

    #[Route('/my-account', name: 'account')]
    public function accountRedirect(UsersRepository $usersRepository, ShopsRepository $shopsRepository,
                                    Request $request, EntityManagerInterface $entityManager, GoodsRepository $goodsRepository, BasketRepository $basketRepository)
    {
        $session = $request->getSession();
        $user = $session->get('user');
        if($user){
            $shop = $shopsRepository->findOneBy(array('owner_id' => $user->getId()));

            if(isset($_POST["submitLogin"]))
            {
                $login = $_POST["current-login"];

                if($user->getLogin() != $login && $login != '')
                {
                    $curUser = $user->getLogin();
                    $userChange = $usersRepository->findOneBy(array('login' => $curUser));
                    $userChange->setLogin($login);
                    $entityManager->flush();
                    if($shop)
                    {
                        return $this->render('account.html.twig', ['user' => $user, 'shopName' => $shop->getShopName(),
                            'shopSel' => $shopsRepository->findAll()]);
                    }

                    $basket = $this->displayBasket($basketRepository, $user);

                    return $this->render('account.html.twig', ['user' => $user, 'goodsInBasket' => $basket,
                        'shopSel' => $shopsRepository->findAll()]);
                }
            }

            else if(isset($_POST["submitShopName"]))
            {
                $this->redactShop($shopsRepository, $user, $entityManager);
            }

            if($shop)
            {
                if(isset($_POST["submitNewGood"]))
                {
                    $this->addNewGood($shop, $entityManager, $goodsRepository);
                }
                return $this->render('account.html.twig', ['user' => $user, 'shopName' => $shop->getShopName(),
                    'shopSel' => $shopsRepository->findAll()]);
            }

            $basket = $this->displayBasket($basketRepository, $user);
            if(isset($_POST["submitNewOrder"]))
            {
                foreach ($basket as $good)
                {
                    $entityManager->remove($good);
                    $entityManager->flush();
                }
            }


            return $this->render('account.html.twig', ['user' => $user, 'goodsInBasket' => $basket, 'shopSel' => $shopsRepository->findAll()]);
        }


        return $this->render('login.html.twig');
    }

    public function redactShop(ShopsRepository $shopsRepository, Users $user, EntityManagerInterface $entityManager)
    {
        $shopName = $_POST["shop-name-inp"];
        $findShop = $shopsRepository->findOneBy(array('owner_id' => $user->getId()));
        if($findShop){
            if($shopName != $findShop->getShopName() && $shopName != '')
            {
                $findShop->setShopName($shopName);
                $entityManager->flush();

                return $this->render('account.html.twig', ['user' => $user, 'shopName' => $shopName,
                    'shopSel' => $shopsRepository->findAll()]);
            }

            return $this->render('account.html.twig', ['user' => $user, 'shopName' => $findShop->getShopName(),
                'shopSel' => $shopsRepository->findAll()]);
        }
        else if($shopName != '')
        {
            $newShop = new Shops();
            $newShop->setShopName($shopName);
            $newShop->setOwnerId($user);
            $entityManager->persist($newShop);
            $entityManager->flush();
            $entityManager->close();

            return $this->render('account.html.twig', ['user' => $user, 'shopName' => $shopName, 'shopSel' => $shopsRepository->findAll()]);
        }

        return $this->render('account.html.twig', ['user' => $user, 'shopSel' => $shopsRepository->findAll()]);
    }

    public function addNewGood(Shops $shop, EntityManagerInterface $entityManager, GoodsRepository $goodsRepository)
    {
        $goodName = $_POST["good-name"];
        $goodCost = $_POST["good-cost"];
        $goodPic = $_POST["good-pic"];

        if($goodPic != '' && $goodCost != '' && is_int((int)$goodCost) && $goodName != '')
        {
            $checkIfGoodExists = $goodsRepository->findOneBy(array('good_name' => $goodName, 'shop_id' => $shop->getId()));
            if(!$checkIfGoodExists)
            {
                $newGood = new Goods();
                $newGood->setGoodName($goodName);
                $newGood->setCost($goodCost);
                $newGood->setPicture($goodPic);
                $newGood->setShopId($shop);
                $entityManager->persist($newGood);
                $entityManager->flush();
                $entityManager->close();
            }
        }
    }

    public function displayBasket(BasketRepository $basketRepository, Users $user)
    {
        $allGoods = $basketRepository->findBy(array('user_id' => $user));

        return $allGoods;
    }
}