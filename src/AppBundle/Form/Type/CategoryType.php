<?php
namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FormType
 * @package AppBundle\Form\Type;
 */
class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Naam:', 'required' => true])
            ->add('imageName', FileType::class, ['label' => 'Afbeelding:', 'required' => false,'data_class' => null])
            ->add('subcategory', EntityType::class, array(
                // query choices from this entity
                'class' => 'AppBundle\Entity\Subcategory',

                // use the User.username property as the visible option string
                'choice_label' => 'name',
                'label' => 'Onderdelen',
                'multiple' => true,
            ))
            ->add('save', SubmitType::class, ['label' => 'Opslaan']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Category',
        ));
    }
}