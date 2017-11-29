<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Frame;
use AppBundle\Entity\Subcategory;
use AppBundle\Form\Type\CategoryType;
use AppBundle\Form\Type\FrameType;
use AppBundle\Form\Type\SubcategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/beheer/categorie", name="admin_category")
     * Load all categories and pass them to paginator.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexCategoryAction(Request $request)
    {
        // Findall in entity Category.
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

        //KNP Paginator.
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $categories,
            $request->query->getInt('page', 1), // page number
            10  // limit per page
        );

        return $this->render('admin/category.html.twig', array(
            'categories' => $pagination

        ));
    }

    /**
     * @Route("/beheer/categorie/nieuw", name="admin_category_new")
     * Create a new Category with data from the form CategoryType.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function CreateCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        // Check if the form is submitted & valid.
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UploadedFile $file
             */
            // Changing the image name with md5.
            $file=$category->getImageName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file into directory.
            $file->move(
              $this->getParameter('image_directory'),$fileName
            );

            // Saving the new category.
            $category->setImageName($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_category');
        }

        return $this->render('admin/categorynew.html.twig', [
            'category' => $form->createView()
        ]);
    }

    /**
     * @Route("/beheer/categorie/verwijderen/{id}", name="category_delete")
     * Delete the category by id.
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteCategoryAction($id)
    {
        // Find id in entity Category
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Category')->find($id);

        // If categories doesn't exist redirect them back.
        if (!$categories) {
            return $this->redirectToRoute('admin_category');
        }

        // Delete and save.
        $em->remove($categories);
        $em->flush();

        return $this->redirectToRoute('admin_category');
    }

    /**
     * @Route("/beheer/categorie/bijwerken/{id}", name="category_edit")
     * Edit the category by id.
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editCategoryAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Category')->find($id);
        $form = $this->createForm(CategoryType::class, $categories);
        $form->handleRequest($request);

        // Check if the form is submitted & valid.
        if ($form->isSubmitted() && $form->isValid()) {

            // Changing the image name with md5.
            $file=$categories->getImageName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file into directory.
            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            // Saving the edited category.
            $categories->setImageName($fileName);
            $em->persist($categories);
            $em->flush();

            return $this->redirectToRoute('admin_category');
        }

        return $this->render('admin/categorynew.html.twig', [
            'category' => $form->createView()
        ]);
    }

    /**
     * @Route("/beheer/subcategorie", name="admin_subcategory")
     */
    public function indexSubcategoryAction(Request $request)
    {
        $subcategories = $this->getDoctrine()->getRepository('AppBundle:Subcategory')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $subcategories, /* query NOT result */
            $request->query->getInt('page', 1), // page number
            10  // limit per page
        );

        return $this->render('admin/subcategory.html.twig', array(
            'subcategories' => $pagination
        ));
    }

    /**
     * @Route("/beheer/subcategorie/nieuw", name="admin_subcategory_new")
     */
    public function CreateSubcategoryAction(Request $request)
    {
        $subcategory = new Subcategory();
        $form = $this->createForm(SubcategoryType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $file=$subcategory->getImageName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            $subcategory->setImageName($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($subcategory);
            $em->flush();

            return $this->redirectToRoute('admin_subcategory');
        }

        return $this->render('admin/subcategorynew.html.twig', [
            'subcategory' => $form->createView()
        ]);
    }

    /**
     * @Route("/beheer/subcategorie/verwijderen/{id}", name="subcategory_delete")
     *
     * Delete subcategory by id.
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteSubcategoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $subcategories = $em->getRepository('AppBundle:Subcategory')->find($id);

        if (!$subcategories) {
            return $this->redirectToRoute('admin_subcategory');
        }

        $em->remove($subcategories);
        $em->flush();

        return $this->redirectToRoute('admin_subcategory');
    }

    /**
     * @Route("/beheer/subcategorie/bijwerken/{id}", name="subcategory_edit")
     *
     * Handles the edit request.
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editSubcategoryAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $subcategories = $em->getRepository('AppBundle:Subcategory')->find($id);

        $form = $this->createForm(SubcategoryType::class, $subcategories);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file=$subcategories->getImageName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            $subcategories->setImageName($fileName);
            $em->persist($subcategories);
            $em->flush();

            return $this->redirectToRoute('admin_subcategory');
        }

        return $this->render('admin/subcategorynew.html.twig', [
            'subcategory' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     * Loads the twig template for the login page.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function LoginAction()
    {
       // Render twig template.
        return $this->render('admin/login.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/beheer/frame", name="admin_frame")
     */
    public function indexFrameAction(Request $request)
    {
        $frames = $this->getDoctrine()->getRepository('AppBundle:Frame')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $frames, /* query NOT result */
            $request->query->getInt('page', 1), // page number
            10  // limit per page
        );

        return $this->render('admin/frame.html.twig', array(
            'frames' => $pagination
        ));
    }

    /**
     * @Route("/beheer/frame/nieuw", name="admin_frame_new")
     */
    public function newFrameAction(Request $request)
    {
        $frame = new Frame();
        $form = $this->createForm(FrameType::class, $frame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UploadedFile $file
             */

            $file=$frame->getImageName();
            list($width, $height) = getimagesize($file);
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            $frame->setImageName($fileName);
            $frame->setImageWidth($width);
            $frame->setImageHeight($height);
            $em=$this->getDoctrine()->getManager();
            $em->persist($frame);
            $em->flush();

            return $this->redirectToRoute('admin_frame');
        }

        return $this->render('admin/framenew.html.twig', [
            'frame' => $form->createView()
        ]);
    }

    /**
     * @Route("/beheer/frame/verwijderen/{id}", name="frame_delete")
     *
     * Delete frame by id.
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteFrameAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $frames = $em->getRepository('AppBundle:Frame')->find($id);

        if (!$frames) {
            return $this->redirectToRoute('admin_frame');
        }

        $em->remove($frames);
        $em->flush();

        return $this->redirectToRoute('admin_frame');
    }

    /**
     * @Route("/beheer/frame/bijwerken/{id}", name="frame_edit")
     *
     * Handles the edit request.
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editFrameAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $frames = $em->getRepository('AppBundle:Frame')->find($id);

        $form = $this->createForm(FrameType::class, $frames);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file=$frames->getImageName();
            list($width, $height) = getimagesize($file);
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            $frames->setImageName($fileName);
            $frames->setImageWidth($width);
            $frames->setImageHeight($height);
            $em->persist($frames);
            $em->flush();

            return $this->redirectToRoute('admin_frame');
        }

        return $this->render('admin/framenew.html.twig', [
            'frame' => $form->createView()
        ]);
    }

}
