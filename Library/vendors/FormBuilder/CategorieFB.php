<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\MinLengthValidator;
use OCFram\NotNullValidator;
use OCFram\RuleValidator;
use OCFram\StringField;
use OCFram\HiddenField;

class CategorieFB extends FormBuilder
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
                    new NotNullValidator('Merci de renseigner votre nom.'),
                    new MaxLengthValidator('Le nom renseigné est trop long (20 caractères maximum)', 20),
                    new MinLengthValidator('Le nom renseigné est trop court (2 caractères minimum)', 2),
                    new RuleValidator('Accents, apostrophe, espace et tiret autorisés.', self::RULE_NOM),
                ],
            ]));
    }
}