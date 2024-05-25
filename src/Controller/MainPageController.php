<?php

namespace App\Controller;

use App\Repository\ShopsRepository;
use http\Env;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MainPageController extends AbstractController
{
    #[Route('/', methods: ['GET'])]
    public function index(Request $request, ShopsRepository $shopsRepository)
    {
        $shops = $shopsRepository->findAll();

        if($shops)
        {
            return $this->render('indexMain.html.twig', ['shops' => $shops]);
        }
        return $this->render('indexMain.html.twig');
    }
}