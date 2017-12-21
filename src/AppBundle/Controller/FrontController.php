<?php

namespace AppBundle\Controller;

use Doctrine\DBAL\Driver\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class FrontController
 * Manages the front process.
 * @package AppBundle\Controller
 */
class FrontController extends Controller
{
    /**
     * @Route("/", name="category")
     * Load all from entity Category and count visitor.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        // Load all from entity Category.
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        // Load configuration and social entities.
        $configuration = $this->getDoctrine()->getRepository('AppBundle:Configuration')->findAll();
        $socials = $this->getDoctrine()->getRepository('AppBundle:Social')->findAll();

        //opens countlog.txt to read the number of hits
        $datei = fopen("countlog.txt","r");
        $count = fgets($datei,1000);
        fclose($datei);
        $count=$count + 1 ;

        // Set counter as session.
        $session = new Session();
        $session->set('counter', $count);

        // opens countlog.txt to change new hit number
        $datei = fopen("countlog.txt","w");
        fwrite($datei, $count);
        fclose($datei);

        // KNP Paginator
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $categories,
            $request->query->getInt('page', 1),
            8 // limit per page
        );

        return $this->render('default/category.html.twig', array(
            'categories' => $pagination,
            'categoriesmenu' => $categories,
            'configuration' => $configuration,
            'socials' => $socials
        ));
    }

    /**
     * @Route("/subcategorie/{id}", name="category_subcategory")
     * Find all subcategories by id.
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function CatAction($id, Request $request)
    {
        // Load categories for the sidebar menu.
        $catmenu = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Category');
        // Load configuration and social entities.
        $socials = $this->getDoctrine()->getRepository('AppBundle:Social')->findAll();
        $configuration = $this->getDoctrine()->getRepository('AppBundle:Configuration')->findAll();

        // Find subcategory by id.
        $query = $repository->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter("id", $id)
            ->getQuery();

        $categories = $query->getResult();

        // KNP Paginator
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $categories,
            $request->query->getInt('page', 1),
            8 // limit per page
        );

        return $this->render('default/subcategory.html.twig',array(
                'categories' => $pagination,
                'categoriesmenu' => $catmenu,
                'configuration' => $configuration,
                'socials' => $socials
            )
        );
    }

    /**
     * @Route("/frames/{id}", name="subcategory_frame")
     * Find all frames by id.
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function SubAction($id, Request $request)
    {
        // Load categories for the sidebar menu.
        $catmenu = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Subcategory');
        // Load configuration and social entities.
        $socials = $this->getDoctrine()->getRepository('AppBundle:Social')->findAll();
        $configuration = $this->getDoctrine()->getRepository('AppBundle:Configuration')->findAll();

        // Find frames by id.
        $query = $repository->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter("id", $id)
            ->getQuery();

        $subcategories = $query->getResult();

        // KNP Paginator
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $subcategories,
            $request->query->getInt('page', 1),
            8 // limit per page
        );

        return $this->render('default/frames.html.twig',array(
                'subcategories' => $pagination,
                'categoriesmenu' => $catmenu,
                'configuration' => $configuration,
                'socials' => $socials )
        );
    }

    /**
     * @Route("/frame/{id}", name="frames_frame")
     * Get single frame by id.
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function FrameAction($id)
    {
        // Load entity Frame.
        $repository = $this->getDoctrine()->getRepository('AppBundle:Frame');
        // Load configuration and social entities.
        $socials = $this->getDoctrine()->getRepository('AppBundle:Social')->findAll();
        $configuration = $this->getDoctrine()->getRepository('AppBundle:Configuration')->findAll();

        // Find frame by id.
        $query = $repository->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter("id", $id)
            ->getQuery();

        $frames = $query->getResult();

        return $this->render('default/frame.html.twig',array(
                'frames' => $frames,
                'configuration' => $configuration,
                'socials' => $socials )
        );
    }

    /**
     * @Route("/download/{id}", name="download")
     * @param Request $request
     * @param $id
     * @param Connection $conn
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function DownloadAction(Request $request, $id, Connection $conn)
    {
        $stmt = $conn->prepare("
        update frame
        set download = download + 1
        where id = '".$id."'");
        $stmt->execute();

        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }
}
