<?php


namespace App\Controller\Front;

use App\Extensions\Portfolio\Repository\PortraitRepository;
use App\Extensions\Portfolio\Repository\SerieRepository;
use App\Extensions\Portfolio\Repository\SonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SonController extends AbstractController
{
    /**
     * @param SonRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/sons", name="front_son")
     */
    public function list(SonRepository $repository)
    {
        $sons = $repository->findSoundOnline();
        return $this->render('front/son_list.html.twig', [
            'sons'   => $sons
        ]);
    }
}
