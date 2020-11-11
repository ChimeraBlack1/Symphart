<?php

namespace App\Form;

use App\Entity\Sport;
use App\Entity\ListOfPlayers;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SignupFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('playerName')
            // ->add('sport')
            ->add('sport', EntityType::class, [
                'class'       => 'App\Entity\Sport',
                'placeholder' => '',
            ])
            ->add('position')
        ;

        // $builder->addEventListener(
        //     FormEvents::POST_SET_DATA,
        //     function (FormEvent $event) {
        //         $form = $event->getForm();

        //         // this would be your entity, i.e. SportMeetup
        //         $data = $event->getData();

        //         $sport = $data->getSport();
        //         $positions = null === $sport ? [] : $sport->getPositions();

        //         $form->add('position', EntityType::class, [
        //             'class' => 'App\Entity\Position',
        //             'placeholder' => '',
        //             'choices' => $positions,
        //         ]);
        //     }
        // );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ListOfPlayers::class,
        ]);
    }
}
