<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\MinLengthValidator;
use OCFram\NotNullValidator;
use OCFram\RuleValidator;
use OCFram\StringField;
use OCFram\HiddenField;


class TailleFB extends FormBuilder
{
    
    public function build()
    {
        $this->form->add(new HiddenField([
            'label' => '',
            'name' => 'id',
            'value' => '',
        ]))
        ->add(new StringField([
            'label' => 'Nom',
            'name' => 'nom',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Merci de renseigner un nom.'),
                new MaxLengthValidator('Le  nom est trop long (20 caractères maximum)', 20),
                new MinLengthValidator('Le nom est trop court (1 caractères minimum)', 1),
                new RuleValidator('Accents, apostrophe, espace et tiret autorisés.', self::RULE_TAILLE),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Prix',
            'name' => 'prix',
            'maxLength' => 3,
            'validators' => [
                new NotNullValidator('Merci de renseigner un prix.'),
                new MaxLengthValidator('Le prix est trop grand (3 caractères maximum)', 3),
                new MinLengthValidator('Le prix est trop petit (1 caractères minimum)', 1),
                new RuleValidator('Uniquement chiffres autorisés.', self::RULE_PROMO),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Description',
            'name' => 'description',
            'maxLength' => 100,
            'validators' => [
                new NotNullValidator('Merci de renseigner une description.'),
                new MaxLengthValidator('La description est trop longue (50 caractères maximum)', 100),
                new MinLengthValidator('La description est trop courte (5 caractères minimum)', 5),
                new RuleValidator('Accents, apostrophe, espace et tiret autorisés.', self::RULE_ADRESSE),
            ],
        ]));
    }
}