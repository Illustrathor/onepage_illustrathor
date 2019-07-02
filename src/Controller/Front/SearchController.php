<?php


namespace App\Controller\Front;


use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search/{name}", name="front_search")
     * @param $name
     * @param TagRepository $tagRepository
     * @return
     */
    public function searchTags(
        $name,
        TagRepository $tagRepository
    ) {
        $results = $tagRepository->findBy(["name" => $name]);
        return $this->render("front/search.html.twig", [
            "results"   => $results[0] ?? [
                "series" => []
                ],
            "keyword"   => $name
        ]);
    }
}