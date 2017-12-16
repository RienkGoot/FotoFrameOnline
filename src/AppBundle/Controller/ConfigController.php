<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Configuration;
use AppBundle\Entity\Social;
use AppBundle\Form\Type\ConfigurationType;
use AppBundle\Form\Type\SocialType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ContactController
 * Manages the contact form and sends email.
 * @package AppBundle\Controller
 */
class ConfigController extends Controller
{
    /**
     * @Route("beheer/kleuren", name="configuration")
     * Load all configuration records.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        // Load all from entity Configuration.
        $configuration = $this->getDoctrine()->getRepository('AppBundle:Configuration')->findAll();

        return $this->render('admin/configuration.html.twig', [
            'configuration' => $configuration
        ]);
    }

    /**
     * @Route("beheer/kleuren/bijwerken/{id}", name="configuration_edit")
     * Edit the configuration
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function configEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $configuration = $em->getRepository('AppBundle:Configuration')->find($id);
        $form = $this->createForm(ConfigurationType::class, $configuration);
        $form->handleRequest($request);

        // Check if the form is submitted & valid.
        if ($form->isSubmitted() && $form->isValid()) {

            // Changing the image name with md5.
            $file=$configuration->getLogo();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file into directory.
            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            // Saving the edited configuration.
            $configuration->setLogo($fileName);
            $em->persist($configuration);
            $em->flush();

            return $this->redirectToRoute('configuration');
        }

        return $this->render('admin/configurationnew.html.twig', [
            'configuration' => $form->createView()
        ]);
    }

    /**
     * @Route("beheer/socialmedia", name="configuration_social")
     * Load all social media records.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexSocialAction(Request $request)
    {
        // Load all from entity Social.
        $socials = $this->getDoctrine()->getRepository('AppBundle:Social')->findAll();
        return $this->render('admin/socialmedia.html.twig',['socials' => $socials]);
    }

    /**
     * @Route("beheer/socialmedia/nieuw", name="social_new")
     * Create a new social media item.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function socialNewAction(Request $request)
    {
        $social = new Social();
        $form = $this->createForm(SocialType::class, $social);
        $form->handleRequest($request);

        // Check if the form is submitted & valid.
        if ($form->isSubmitted() && $form->isValid()) {

            // Changing the image name with md5.
            $file=$social->getImageName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file into directory.
            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            // Saving the new social media.
            $social->setImageName($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($social);
            $em->flush();

            return $this->redirectToRoute('configuration_social');
        }

        return $this->render('admin/socialmedianew.html.twig', [
            'social' => $form->createView()
        ]);
    }

    /**
     * @Route("/beheer/socialmedia/verwijderen/{id}", name="social_delete")
     * Delete the social media by id.
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteSocialAction($id)
    {
        // Find id in entity Social
        $em = $this->getDoctrine()->getManager();
        $socials = $em->getRepository('AppBundle:Social')->find($id);

        // If social media doesn't exist redirect them back.
        if (!$socials) {
            return $this->redirectToRoute('configuration_social');
        }

        // Delete and save.
        $em->remove($socials);
        $em->flush();

        return $this->redirectToRoute('configuration_social');
    }

    /**
     * @Route("/beheer/socialmedia/bijwerken/{id}", name="social_edit")
     * Edit the social media by id.
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editSocialAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $socials = $em->getRepository('AppBundle:Social')->find($id);
        $form = $this->createForm(SocialType::class, $socials);
        $form->handleRequest($request);

        // Check if the form is submitted & valid.
        if ($form->isSubmitted() && $form->isValid()) {

            // Changing the image name with md5.
            $file=$socials->getImageName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file into directory.
            $file->move(
                $this->getParameter('image_directory'),$fileName
            );

            // Saving the edited social media.
            $socials->setImageName($fileName);
            $em->persist($socials);
            $em->flush();

            return $this->redirectToRoute('configuration_social');
        }

        return $this->render('admin/socialmedianew.html.twig', [
            'social' => $form->createView()
        ]);
    }
}
