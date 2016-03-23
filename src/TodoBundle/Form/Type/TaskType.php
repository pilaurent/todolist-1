<?php

namespace TodoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', null, array(
                'label' => 'task.form.label',
            ))
            ->add('description', null, array(
                'label' => 'task.form.description',
            ))
            ->add('dueDate', null, array(
                'label' => 'task.form.duedate',
            ))
            ->add('remindAt', null, array(
                'label' => 'task.form.remindat',
            ))
            ->add('status', null, array(
                'label' => 'task.form.status',
            ))
            ->add('category')
            ->add('tag')
            ->add('save', SubmitType::class, array(
                'label' => 'task.form.save',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodoBundle\Entity\Task',
        ));
    }
}