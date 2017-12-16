<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FormType
 * Create configuration form.
 * @package AppBundle\Form\Type;
 */
class ConfigurationType extends AbstractType
{
    /**
     * Build the configuration form.
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logo', FileType::class, ['label' => 'Logo:', 'required' => true,'data_class' => null, 'attr'  => array('accept' => 'image/*')])
            ->add('backgroundColor', ColorType::class, ['label' => 'Achtergrond kleur', 'attr'  => array('style' => 'width: 10%')])
            ->add('menuColor', ColorType::class, ['label' => 'Menu kleur', 'attr'  => array('style' => 'width: 10%')])
            ->add('menuFontColor', ColorType::class, ['label' => 'Menu tekst kleur', 'attr'  => array('style' => 'width: 10%')])
            ->add('panelColor', ColorType::class, ['label' => 'Paneel kleur', 'attr'  => array('style' => 'width: 10%')])
            ->add('panelFontColor', ColorType::class, ['label' => 'Paneel tekst kleur', 'attr'  => array('style' => 'width: 10%')])
            ->add('save', SubmitType::class, ['label' => 'Opslaan']);
    }

    /**
     * Use entity configuration.
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Configuration',
        ));
    }
}