<?php
/**
 * Created by PhpStorm.
 * User: twilmshorst
 * Date: 17/04/19
 * Time: 13:36
 */

namespace App\Controller\Front;


use App\Entity\Contact;
use App\Extensions\Portfolio\Entity\Serie;
use App\Extensions\Portfolio\Repository\PortraitRepository;
use App\Form\ContactType;
use App\Extensions\Portfolio\Repository\SonRepository;
use App\Extensions\Portfolio\Repository\SerieRepository;
use App\Repository\ParameterRepository;
use App\Repository\TagRepository;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FrontController extends AbstractController
{

    /**
     * @var CacheManager
     */
    private $imagineCacheManager;
    private $environement;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(CacheManager $imagineCacheManager, UserPasswordEncoderInterface $encoder)
    {
        $this->imagineCacheManager = $imagineCacheManager;
        $this->environement = $_ENV['APP_ENV'];
        $this->encoder = $encoder;
    }


    /**
     * @Route("/", name="homepage")
     */
    public function homepage(ParameterRepository $parameterRepository)
    {
//        $parameter = $parameterRepository->findOneBy(['code' => "localisation"]);
//        dd($parameter);
        return $this->render('front/homepage.html.twig', [

        ]);
    }

    /**
     * @Route("/search/{name}", name="front_search")
     */
    public function searchTags(
        $name,
        TagRepository $tagRepository
    )
    {
        $tag = $tagRepository->findBy(["name" => $name]);
        return $this->render("front/search.html.twig", [
            "tag"   => $tag,
            "keyword"   => $name
        ]);
    }

    /**
     * @param SonRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/multimedias", name="front_multimedia")
     */
    public function multimedia_list(SonRepository $repository)
    {
        $multimedias = $repository->findMultimediaOnline();
        return $this->render('front/multimedia_list.html.twig', [
            'multimedias'   => $multimedias
        ]);
    }


}
