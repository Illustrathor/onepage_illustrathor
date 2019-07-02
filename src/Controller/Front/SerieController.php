<?php


namespace App\Controller\Front;

use App\Extensions\Portfolio\Repository\PortraitRepository;
use App\Extensions\Portfolio\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    /**
     * @Route("/series", name="front_series_list")
     * @param SerieRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(Request $request, SerieRepository $repository)
    {
        $series = $repository->findOnline();
        return $this->render('front/series_list.html.twig', [
            'series'    => $series,
            'controller' => 'front_series_list',
        ]);
    }

    /**
     * @Route("/serie/{name}", name="front_serie")
     */
    public function one($name, SerieRepository $repository)
    {
        $serie = $repository->findOneBy(['slug' => $name]);
        if(null === $serie) return $this->redirectToRoute('homepage');
        return $this->render('front/serie.html.twig', [
            'serie' => $serie,
            'controller' => 'front_collection',
        ]);
    }
}
