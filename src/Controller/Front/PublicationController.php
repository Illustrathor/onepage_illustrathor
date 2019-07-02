<?php

namespace App\Controller\Front;

use App\Extensions\Portfolio\Repository\PublicationRepository;
use App\Repository\ParameterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends AbstractController
{
    /**
     * @Route("/publications", name="front_publications")
     * @param PublicationRepository $repository
     * @param ParameterRepository $parameterRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function portraits(PublicationRepository $repository, ParameterRepository $parameterRepository)
    {
        $publication = $repository->findOnline();
        $silderImages = $parameterRepository->findOneBy(['code' => 'publications_slider'])->getImages();
        return $this->render('front/publications.html.twig', [
            'publications'    => $publication,
            'slider_images' => $silderImages,
            'controller' => 'front_collection',
        ]);
    }
}
