<?php
// src/Controller/IndexController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="calendar")
     */
    public function index()
    {
        return $this->render("index.html.twig", []);
    }
}