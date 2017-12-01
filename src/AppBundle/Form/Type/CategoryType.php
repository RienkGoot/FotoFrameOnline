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
 * Create category form.
 * @package AppBundle\Form\Type;
 */
class CategoryType extends AbstractType
{
    /**
     * Build the category form.
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
                'choice_label' => 'name',
                'required' => false,
                'label' => 'Onderdelen',
                'multiple' => true,
                'attr'=>array('class'=>'chosen-select')
            ))
            ->add('save', SubmitType::class, ['label' => 'Opslaan']);
    }

    /**
     * Use entity Category.
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Category',
        ));
    }
}