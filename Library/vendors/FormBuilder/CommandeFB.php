<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\MinLengthValidator;
use OCFram\NotNullValidator;
use OCFram\RuleValidator;
use OCFram\StringField;
use OCFram\HiddenField;
use OCFram\DateField;


class CommandeFB extends FormBuilder
{
    
    public function build()
    {
        $this->form->add(new HiddenField([
            'label' => '',
            'name' => 'id',
            'value' => '',
        ]))
        ->add(new StringField([
            'label' => 'Montant',
            'name' => 'montant',
            'maxLength' => 5,
            'validators' => [
                new NotNullValidator('Merci de renseigner le montant.'),
                new MaxLengthValidator('Le montant est trop long (5 caractères maximum)', 5),
                new MinLengthValidator('Le montant est trop court (2 caractères minimum)', 2),
                new RuleValidator('Uniquement chiffres autorisés.', self::RULE_PRIX),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Date Commande',
            'name' => 'dateCommande',
            'validators' => [
                new NotNullValidator('Merci de renseigner la date de commande.'),
                new RuleValidator('Mauvais format, la date doit être au format YYYY/mm/dd HH:mm:ss', self::RULE_DATE),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Date Livraison',
            'name' => 'dateLivraison',
            'validators' => [
                new NotNullValidator('Merci de renseigner la date de livraison.'),
                new RuleValidator('Mauvais format, la date doit être au format YYYY/mm/dd HH:mm:ss', self::RULE_DATE),
            ],
        ]))
        ->add(new HiddenField([
            'label' => '',
            'name' => 'idClient',
            'value' => '',
        ]));
    }
}

/*->add(new DateField([
    'label' => 'Date Commande',
    'name' => 'dateCommande',
    'validators' => [
        new NotNullValidator('Merci de renseigner la date de commande.'),
        new RuleValidator('Mauvais format, la date doit être au format YYYY/mm/dd HH:mm:ss', self::RULE_DATE),
    ],
]))
    ->add(new DateField([
        'label' => 'Date Livraison',
        'name' => 'dateLivraison',
        'validators' => [
            new NotNullValidator('Merci de renseigner la date de livraison.'),
            new RuleValidator('Mauvais format, la date doit être au format YYYY/mm/dd HH:mm:ss', self::RULE_DATE),
        ],
    ]))*/