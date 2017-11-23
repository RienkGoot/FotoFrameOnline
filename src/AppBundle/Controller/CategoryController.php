<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @Route("/", name="category")
     */
    public function indexAction()
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

        return $this->render('default/category.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @Route("/category/{id}", name="category_subcategory")
     */
    public function CatAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Category');

        $query = $repository->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter("id", $id)
            ->getQuery();

        $categories = $query->getResult();


        return $this->render('default/subcategory.html.twig',array(
        'categories' => $categories )
        );
    }
}
