<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FormType
 * Create Social media form.
 * @package AppBundle\Form\Type;
 */
class SocialType extends AbstractType
{
    /**
     * Build the social media form.
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Naam'])
            ->add('url', UrlType::class, ['label' => 'URL'])
            ->add('imageName', FileType::class, ['label' => 'Afbeelding:', 'required' => true,'data_class' => null])
            ->add('save', SubmitType::class, ['label' => 'Opslaan']);
    }

    /**
     * Use entity Social.
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Social',
        ));
    }
}