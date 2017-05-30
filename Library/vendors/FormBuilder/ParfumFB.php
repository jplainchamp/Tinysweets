<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\MinLengthValidator;
use OCFram\NotNullValidator;
use OCFram\RuleValidator;
use OCFram\StringField;
use OCFram\HiddenField;


class ParfumFB extends FormBuilder
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
            'maxLength' => 50,
            'validators' => [
                new NotNullValidator('Merci de renseigner un nom.'),
                new MaxLengthValidator('Le nom est trop long (50 caractères maximum)', 50),
                new MinLengthValidator('Le nom est trop court (5 caractères minimum)', 5),
                new RuleValidator('Accents, apostrophe, espace et tiret autorisés.', self::RULE_PARFUM),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Prix',
            'name' => 'prix',
            'maxLength' => 2,
            'validators' => [
                new NotNullValidator('Merci de renseigner un prix.'),
                new MaxLengthValidator('Le prix est trop grand (2 caractères maximum)', 2),
                new MinLengthValidator('Le prix est trop petit (1 caractères minimum)', 1),
                new RuleValidator('Uniquement chiffres autorisés.', self::RULE_PROMO),
            ],
        ]));
    }
}