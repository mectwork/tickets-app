<?php
namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GroupType extends AbstractType
{

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Group'
        ));
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('roles', ChoiceType::class, array(
                    'choices'  => array(
                        'ROL_ADMINISTRADOR' => 'Administrador', 
                        'ROL_SOPORTE' => 'Soporte',
                        'ROL_USUARIO' => 'Usuario'),
                    'required' => true,
                    'multiple' => true,
                ));          
    }
}
