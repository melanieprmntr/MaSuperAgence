<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/')]
class HomeController extends AbstractController
{
    public function index(PropertyRepository $repository): Response
    {
        $properties = $repository->findLatest();
        return $this->render('home/index.html.twig', [
            'properties' => $properties,
        ]);
    }
}
