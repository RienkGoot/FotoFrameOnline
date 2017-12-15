<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class FormType
 * Create the contact form.
 * @package AppBundle\Form\Type;
 */
class ContactType extends AbstractType
{
    /**
     * Build the contact form.
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Naam:', 'required' => true])
            ->add('email', EmailType::class, ['label' => 'Email:', 'required' => true])
            ->add('telephone', TelType::class, ['label' => 'Telefoon:', 'required' => false])
            ->add('subject', TextType::class, ['label' => 'Onderwerp:', 'required' => false])
            ->add('message', TextareaType::class, ['label' => 'Bericht:', 'required' => true, 'attr' => ['rows' => '10']])
            ->add('save', SubmitType::class, ['label' => 'Versturen']);
    }
}