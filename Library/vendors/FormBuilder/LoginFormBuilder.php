<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\StringField;
use OCFram\PasswordField;

class LoginFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Pseudo',
            'name' => 'pseudo',
            'maxLength' => 15,
        ]))
            ->add(new PasswordField([
                'label' => 'Mot de passe',
                'name' => 'mdp',
                'maxLength' => 20,
            ]));
    }
}