<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $message = (new \Swift_Message($form->getData()['subject']))
                ->setFrom($form->getData()['email'])
                ->setTo('lubujeku@tinoza.org')
                ->setBody(
                    $this->renderView(
                        'email/contact.html.twig',
                        array('name' => $form->getData()['name'], 'email' => $form->getData()['email'], 'telephone' => $form->getData()['telephone'], 'message' => $form->getData()['message'] )
                    ),
                    'text/html'
                );

            $this->get('mailer')->send($message);
            $this->addFlash('success', 'Mail verzonden.');
        }

        return $this->render('default/contact.html.twig', [
            'contact' => $form->createView()
        ]);
    }
}
