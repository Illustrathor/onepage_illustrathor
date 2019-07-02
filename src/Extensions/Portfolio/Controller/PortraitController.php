<?php

namespace App\Extensions\Portfolio\Controller;

use App\Extensions\Portfolio\Entity\Portrait;
use App\Extensions\Portfolio\Form\PortraitType;
use App\Extensions\Portfolio\Repository\PortraitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/extension/portfolio/portrait")
 */
class PortraitController extends AbstractController
{
    /**
     * @Route("/", name="portrait_index", methods={"GET"})
     */
    public function index(PortraitRepository $portraitRepository): Response
    {
        return $this->render('@damnPortfolio/portrait/index.html.twig', [
            'portraits' => $portraitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="portrait_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $portrait = new Portrait();
        $form = $this->createForm(PortraitType::class, $portrait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($portrait);
            $entityManager->flush();

            return $this->redirectToRoute('portrait_index');
        }

        return $this->render('@damnPortfolio/portrait/new.html.twig', [
            'portrait' => $portrait,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="portrait_show", methods={"GET"})
     */
    public function show(Portrait $portrait): Response
    {
        return $this->render('@damnPortfolio/portrait/show.html.twig', [
            'portrait' => $portrait,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="portrait_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Portrait $portrait): Response
    {
        $form = $this->createForm(PortraitType::class, $portrait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('portrait_index', [
                'id' => $portrait->getId(),
            ]);
        }

        return $this->render('@damnPortfolio/portrait/edit.html.twig', [
            'portrait' => $portrait,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="portrait_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Portrait $portrait): Response
    {
        if ($this->isCsrfTokenValid('delete'.$portrait->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($portrait);
            $entityManager->flush();
        }

        return $this->redirectToRoute('portrait_index');
    }
}
