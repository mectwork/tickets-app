<?php
namespace UserBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class UserType extends AbstractType
{

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPresetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPresubmit'));
        $builder->add('nombrecompleto')
            ->add('username')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('plain_password', PasswordType::class)
            ->add('empresa')
            ->add('groups')
            ->add('enabled');
    }

    public function onPresetData(FormEvent $event)
    {
        $form = $event->getForm();
        /** @var \UserBundle\Entity\User $data */
        $data = $event->getData();

        if ($data->getEmpresa() !== null) {
            $empresaId = $data->getEmpresa()->getId();
            $form->add('proyectos', EntityType::class, array(
                'multiple' => true,
                'class' => 'AppBundle\Entity\Proyecto',
                'query_builder' => function (EntityRepository $er) use ($empresaId) {
                    $qb = $er->createQueryBuilder('p');

                    return $qb->where($qb->expr()->eq('p.empresa', ':empresa'))
                        ->setParameter('empresa', $empresaId);
                },
                'data' => $data->getProyectos(),
            ));
        } else {
            $form->add('proyectos', EntityType::class, array(
                'multiple' => true,
                'class' => 'AppBundle\Entity\Proyecto',));
        }
    }

    public function onPresubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        if (isset($data['empresa']) && !empty($data['empresa'])) {
            $empresa = $data['empresa'];

            $form->add('proyectos', EntityType::class, array(
                'multiple' => true,
                'class' => 'AppBundle\Entity\Proyecto',
                'query_builder' => function (EntityRepository $er) use ($empresa) {
                    $qb = $er->createQueryBuilder('p');

                    return $qb->where($qb->expr()->eq('p.empresa', ':empresa'))
                        ->setParameter('empresa', $empresa);
                },
                'data' => $data['proyectos'],
            ));
        } else {
            $form->add('proyectos', EntityType::class, array(
                'multiple' => true,
                'class' => 'AppBundle\Entity\Proyecto',));
        }
    }
}
