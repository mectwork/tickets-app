<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActividadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proyecto', EntityType::class, array(
                'class' => 'AppBundle:Proyecto',
                'required' => true,
                'label' => 'Proyecto',
            ))
            ->add('estado', ChoiceType::class, array(
                'choices' => array(
                    'Abierta'=>'Abierta',
                    'En preceso'=>'En preceso',
                    'Completada'=>'Completada'),
            ))
            ->add('tipo', ChoiceType::class, array(
                'choices' => array(
                    'Pregunta' => 'Pregunta',
                    'Issue' => 'Issue',
                    'Nueva Funcionalidad'=> 'Nueva Funcionalidad'),

            ))
            ->add('titulo')
            ->add('contenido');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Actividad'
        ));
    }
}
