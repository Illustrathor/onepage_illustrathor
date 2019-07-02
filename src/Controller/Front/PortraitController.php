<?php

namespace App\Controller\Front;

use App\Extensions\Portfolio\Repository\PortraitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PortraitController extends AbstractController
{
    /**
     * @Route("/portraits", name="front_portraits")
     */
    public function portraits(PortraitRepository $repository)
    {
        $portraits = $repository->findOnline();
        //dd($portraits);
        return $this->render('front/portraits.html.twig', [
            'portraits'    => $portraits,
            'controller' => 'front_collection',
        ]);
    }
}
