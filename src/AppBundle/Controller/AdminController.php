<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Frame;
use AppBundle\Entity\Subcategory;
use AppBundle\Form\Type\CategoryType;
use AppBundle\Form\Type\FrameType;
use AppBundle\Form\Type\SubcategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin/category", name="admin_category")
     *
     */
    public function indexCategoryAction(Request $request)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

        return $this->render('admin/category.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @Route("/admin/category/new", name="admin_category_new")
     */
    public function CreateCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $file=$category->getImageName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
              $this->getParameter('image_directory'),$fileName
            );

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
     * @Route("/admin/category/delete/{id}", name="category_delete")
     *
     * Delete category by id.
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteCategoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Category')->find($id);

        if (!$categories) {
            return $this->redirectToRoute('admin_category');
        }

        $em->remove($categories);
        $em->flush();

        return $this->redirectToRoute('admin_category');
    }

    /**
     * @Route("/admin/category/edit/{id}", name="category_edit")
     *
     * Handles the edit request.
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

        if ($form->isSubmitted() && $form->isValid()) {

            $file=$categories->getImageName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

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
     * @Route("/admin/subcategory", name="admin_subcategory")
     */
    public function indexSubcategoryAction(Request $request)
    {
        $subcategories = $this->getDoctrine()->getRepository('AppBundle:Subcategory')->findAll();

        return $this->render('admin/subcategory.html.twig', array(
            'subcategories' => $subcategories
        ));
    }

    /**
     * @Route("/admin/subcategory/new", name="admin_subcategory_new")
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
     * @Route("/admin/subcategory/delete/{id}", name="subcategory_delete")
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
     * @Route("/admin/subcategory/edit/{id}", name="subcategory_edit")
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
    */
    public function LoginAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('admin/login.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/admin/frame", name="admin_frame")
     */
    public function indexFrameAction(Request $request)
    {
        $frames = $this->getDoctrine()->getRepository('AppBundle:Frame')->findAll();

        return $this->render('admin/frame.html.twig', array(
            'frames' => $frames
        ));
    }

    /**
     * @Route("/admin/frame/new", name="admin_frame_new")
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
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            $frame->setImageName($fileName);
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
     * @Route("/admin/frame/delete/{id}", name="frame_delete")
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
     * @Route("/admin/frame/edit/{id}", name="frame_edit")
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
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            $frames->setImageName($fileName);
            $em->persist($frames);
            $em->flush();

            return $this->redirectToRoute('admin_frame');
        }

        return $this->render('admin/framenew.html.twig', [
            'frame' => $form->createView()
        ]);
    }

}
