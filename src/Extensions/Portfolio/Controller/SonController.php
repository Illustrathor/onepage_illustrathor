<?php

namespace App\Extensions\Portfolio\Controller;

use App\Extensions\Portfolio\Entity\Son;
use App\Extensions\Portfolio\Form\SonType;
use App\Extensions\Portfolio\Repository\SonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/extension/portfolio/son")
 */
class SonController extends AbstractController
{
    /**
     * @Route("/", name="son_index", methods={"GET"})
     */
    public function index(SonRepository $sonRepository): Response
    {
        return $this->render('@damnPortfolio/son/index.html.twig', [
            'sons' => $sonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="son_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $son = new Son();
        $form = $this->createForm(SonType::class, $son);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($son);
            $entityManager->flush();

            return $this->redirectToRoute('son_index');
        }

        return $this->render('@damnPortfolio/son/new.html.twig', [
            'son' => $son,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="son_show", methods={"GET"})
     */
    public function show(Son $son): Response
    {
        $son->setEmbed();
        return $this->render('@damnPortfolio/son/show.html.twig', [
            'son' => $son,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="son_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Son $son): Response
    {
        $form = $this->createForm(SonType::class, $son);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('son_index', [
                'id' => $son->getId(),
            ]);
        }

        return $this->render('@damnPortfolio/son/edit.html.twig', [
            'son' => $son,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="son_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Son $son): Response
    {
        if ($this->isCsrfTokenValid('delete'.$son->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($son);
            $entityManager->flush();
        }

        return $this->redirectToRoute('son_index');
    }
}
