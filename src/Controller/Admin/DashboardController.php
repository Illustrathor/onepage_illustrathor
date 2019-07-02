<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller
 * @Route("/admin")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index()
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'breadcrumb'    => [
                [
                    "name" => "Dashboard"
                ]
            ]
        ]);
    }

    /**
     * @Route("/tags.json", name="tags", defaults={"_format": "json"})
     */
    public function tagsAction()
    {
        $tags = $this->getDoctrine()->getRepository('app:Tag')->findBy([], ['name' => 'ASC']);

        return $this->render('admin/dashboard/tags.json.twig', ['tags' => $tags]);
    }
}
