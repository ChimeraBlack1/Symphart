<?php

namespace App\Form;

use App\Entity\Sport;
use App\Entity\Position;
use App\Entity\PlayerList;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class NewPlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('sport', EntityType::class, [
                'class' => Sport::class,
                'mapped' => false,
            ])
            ->add('position', EntityType::class, [
                'class' => Position::class,
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlayerList::class,
        ]);
    }
}
