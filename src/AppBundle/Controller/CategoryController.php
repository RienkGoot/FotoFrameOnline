<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryController
 *
 * @package AppBundle\Controller
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="category")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $categories, /* query NOT result */
            $request->query->getInt('page', 1), // page number
            8 // limit per page
        );

        return $this->render('default/category.html.twig', array(
            'categories' => $pagination,
            'categoriesmenu' => $categories
        ));
    }

    /**
     * @Route("/subcategory/{id}", name="category_subcategory")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function CatAction($id)
    {
        $catmenu = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Category');

        $query = $repository->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter("id", $id)
            ->getQuery();

        $categories = $query->getResult();

        return $this->render('default/subcategory.html.twig',array(
        'categories' => $categories,
        'categoriesmenu' => $catmenu )
        );
    }

    /**
     * @Route("/frames/{id}", name="subcategory_frame")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function SubAction($id)
    {
        $catmenu = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Subcategory');

        $query = $repository->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter("id", $id)
            ->getQuery();

        $subcategories = $query->getResult();

        return $this->render('default/frames.html.twig',array(
            'subcategories' => $subcategories,
            'categoriesmenu' => $catmenu )
        );
    }

    /**
     * @Route("/frame/{id}", name="frames_frame")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function FrameAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Frame');

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
