<?php

namespace AppBundle\Controller;

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

        //Open .txt and read number.
        $handle=fopen("counter.txt", "w+");
        $counter=(int) fread($handle, 20);
        fclose($handle);
        $counter++;

        // Set counter as session.
        $session = new Session();
        $session->set('counter', $counter);
        $counter = $session->get('counter');

        // Re-open the file for update the count.
        $handle= fopen("counter.txt", "w");
        fwrite($handle, $counter);
        fclose($handle);

        // KNP Paginator
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $categories,
            $request->query->getInt('page', 1),
            8 // limit per page
        );

        return $this->render('default/category.html.twig', array(
            'categories' => $pagination,
            'categoriesmenu' => $categories
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
                'categoriesmenu' => $catmenu )
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
                'categoriesmenu' => $catmenu )
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

        // Find frame by id.
        $query = $repository->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter("id", $id)
            ->getQuery();

        $frames = $query->getResult();

        return $this->render('default/frame.html.twig',array(
                'frames' => $frames )
        );
    }
}
