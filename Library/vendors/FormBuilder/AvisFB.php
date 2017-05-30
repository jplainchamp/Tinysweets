<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\MinLengthValidator;
use OCFram\NotNullValidator;
use OCFram\RuleValidator;
use OCFram\StringField;
use OCFram\HiddenField;
use OCFram\TextField;


class AvisFB extends FormBuilder
{
       public function build()
    {
        $this->form->add(new HiddenField([
            'label' => '',
            'name' => 'id',
            'value' => '',
        ]))
        ->add(new TextField([
            'label' => 'Commentaire',
            'name' => 'commentaire',
            'maxLength' => 255,
            'validators' => [
                new NotNullValidator('Merci de renseigner un commentaire.'),
                new MaxLengthValidator('Le  commentaire est trop long (255 caractères maximum)', 255),
                new MinLengthValidator('Le commentaire est trop court (2 caractères minimum)', 2),
                new RuleValidator('Accents, apostrophe, espace et tiret autorisés.', self::RULE_COMMENTAIRE),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Note',
            'name' => 'note',
            'maxLength' => 1,
            'validators' => [
                new NotNullValidator('Merci de renseigner une note.'),
                new MaxLengthValidator('La note est trop grand (1 caractères maximum)', 1),
                new MinLengthValidator('La note est trop petit (1 caractères minimum)', 1),
                new RuleValidator('Uniquement chiffres autorisés.', self::RULE_NOTE),
            ],
        ]));
    }
}