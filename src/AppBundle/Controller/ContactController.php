<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ContactController
 * Manages the contact form and sends email.
 * @package AppBundle\Controller
 */
class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     * Gets form and send it with mailer.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        // Load configuration and social entities.
        $configuration = $this->getDoctrine()->getRepository('AppBundle:Configuration')->findAll();
        $socials = $this->getDoctrine()->getRepository('AppBundle:Social')->findAll();

        // Create form ContactType
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        // If the form is submitted and valid.
        if ($form->isSubmitted() && $form->isValid()) {

                // Get the submitted form data
                $email = $form["email"]->getData();
                $name = $form["name"]->getData();
                $telephone = $form["telephone"]->getData();
                $subject = $form["subject"]->getData();
                $message = $form["message"]->getData();

                // Check whether submitted data is not empty
                if(!empty($email) && !empty($name) && !empty($subject) && !empty($message)){

                    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                        $this->addFlash('success', 'Geen geldig email.');
                    }else{
                        // Recipient email
                        $toEmail = 'myphotoframeonline@gmail.com';
                        $emailSubject = 'Contact formulier ingevuld door: '.$name;
                        $htmlContent = '<h2>Contact formulier</h2>
                         <h4>Naam</h4><p>'.$name.'</p>
                         <h4>Email</h4><p>'.$email.'</p>
                         <h4>Telefoon</h4><p>'.$telephone.'</p>
                         <h4>Onderwerp</h4><p>'.$subject.'</p>
                         <h4>Bericht</h4><p>'.$message.'</p>';

                        // Set content-type header for sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                        // Additional headers
                        $headers .= 'From: '.$name.'<'.$email.'>'. "\r\n";

                        // Send email
                        if(mail($toEmail,$emailSubject,$htmlContent,$headers)){
                            $this->addFlash('success', 'Mail verzonden.');
                            return $this->redirectToRoute('contact');
                        }
                    }
                }
            }

        return $this->render('default/contact.html.twig', [
            'contact' => $form->createView(),
            'configuration' => $configuration,
            'socials' => $socials
        ]);
    }
}
