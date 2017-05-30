<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\MinLengthValidator;
use OCFram\NotNullValidator;
use OCFram\RuleValidator;
use OCFram\StringField;
use OCFram\HiddenField;


class PromoFB extends FormBuilder
{
    
    public function build()
    {
        $this->form->add(new HiddenField([
            'label' => '',
            'name' => 'id',
            'value' => '',
        ]))
        ->add(new StringField([
            'label' => 'Code promotion',
            'name' => 'codePromo',
            'maxLength' => 15,
            'validators' => [
                new NotNullValidator('Merci de renseigner un code promotion.'),
                new MaxLengthValidator('Le code promotion est trop long (15 caractères maximum)', 15),
                new MinLengthValidator('Le code promotion est trop court (5 caractères minimum)', 5),
                new RuleValidator('Lettres et chiffres autorisés.', self::RULE_PSEUDO),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Reduction',
            'name' => 'reduction',
            'maxLength' => 2,
            'validators' => [
                new NotNullValidator('Merci de renseigner une réduction.'),
                new MaxLengthValidator('La réduction est trop longue (2 caractères maximum)', 2),
                new MinLengthValidator('La réduction est trop courte (1 caractères minimum)', 1),
                new RuleValidator('Uniquement chiffres autorisés.', self::RULE_PROMO),
            ],
        ]));
    }
}