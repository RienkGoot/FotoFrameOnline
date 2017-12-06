<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FormType
 * Create frame form.
 * @package AppBundle\Form\Type;
 */
class FrameType extends AbstractType
{
    /**
     * Build the frame form.
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Naam:', 'required' => true])
            ->add('imageName', FileType::class, ['label' => 'Afbeelding:', 'required' => true,'data_class' => null])
            ->add('save', SubmitType::class, ['label' => 'Opslaan']);
    }

    /**
     * Use entity Frame.
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Frame',
        ));
    }
}