<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\Goods;
use App\Repository\BasketRepository;
use App\Repository\GoodsRepository;
use App\Repository\ShopsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use http\Env;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ShopController extends AbstractController
{
    //redo mapping pleazz
    #[Route('/shop/{id}',  name: 'app_shop')]
    public function indexShop(Request $request, ShopsRepository $shopsRepository, GoodsRepository $goodsRepository,
                              EntityManagerInterface $entityManager, BasketRepository $basketRepository)
    {
        $params = $request->attributes->get('_route_params');
        $idShop = $params['id'];
        $shop = $shopsRepository->findOneBy(array('id' => $idShop));
        $allGoodsFromShop = $goodsRepository->findBy(array('shop_id' => $shop->getId()));

        foreach ($allGoodsFromShop as $good)
        {
            $session = $request->getSession();
            $user = $session->get('user');

            if(isset($_POST["add-to-basket-now-".$good->getId()]) && isset($_POST["num-of-goods-".$good->getId()])
            && intval($_POST["num-of-goods-".$good->getId()]))
            {
                $alreadyExists = $basketRepository->findOneBy(array('user_id' => $user->getId(), 'good_id' => $good));
                $colvo = intval($_POST["num-of-goods-".$good->getId()]);
                if($alreadyExists)
                {
                    $alreadyExists->setNumber($colvo);
                    $entityManager->flush();
                    $entityManager->close();
                }
                else
                {
                    $newBasket = new Basket();
                    $newBasket->setNumber($colvo);
                    $newBasket->setGoodId($good);
                    $newBasket->setUserId($user->getId());
                    $entityManager->persist($newBasket);
                    $entityManager->flush();
                    $entityManager->close();
                }
            }
            else if($user->isHasAbilityForShop() && isset($_POST["add-to-basket-now-".$good->getId()]))
            {
                return $this->render('exception.html.twig', ['exception' => 'аккаунт предпринимателя']);
            }
        }
        if($shop)
        {
            $shopGoods = $goodsRepository->findBy(array('shop_id' => $idShop));
            return $this->render('shop.html.twig', ['shop' => $shop, 'goods' => $shopGoods,
                'shopSel' => $shopsRepository->findAll()]);
        }

        else
        {
            return $this->render('exception.html.twig', ['exception' => 'ошибка 404']);
        }
    }
}