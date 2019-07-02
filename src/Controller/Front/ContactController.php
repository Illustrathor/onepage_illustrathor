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

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="front_contact", methods={"GET","POST"})
     */
    public function contact(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->render('front/contact.html.twig', [
                'contact' => $contact,
                'message'   => 'You message has been sent!'
            ]);
        }

        return $this->render('front/contact.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }
}
