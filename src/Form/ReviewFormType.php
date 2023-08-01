<?php

namespace App\Form;

use App\Model\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewFormType extends AbstractType
{
    const MEALS = [
        "Pizza",
        "Burger",
        "Sushi",
        "Pasta Carbonara",
        "Chicken Curry",
        "Tacos",
        "Steak",
        "Salad Nicoise",
        "Fish and Chips",
        "Pad Thai",
        "Hamburger",
        "Chicken Alfredo",
        "Ramen",
        "Lasagna",
        "Hot Dog",
        "Shrimp Scampi",
        "Chicken Parmesan",
        "Biryani",
        "Spaghetti Bolognese",
        "Pho",
        "Beef Stroganoff",
        "Caesar Salad",
        "Peking Duck",
        "Miso Soup",
        "Gyros",
        "Tom Yum Goong",
        "Lobster Thermidor",
        "Chicken Shawarma",
        "Tandoori Chicken",
        "Chili Con Carne"
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('meal', ChoiceType::class, [
                'choices' => array_combine(self::MEALS, self::MEALS),
                'autocomplete' => true,
                'multiple' => true
            ])
            ->add('comment', TextareaType::class)
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}