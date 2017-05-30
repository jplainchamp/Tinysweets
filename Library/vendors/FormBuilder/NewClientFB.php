<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\MinLengthValidator;
use OCFram\NotNullValidator;
use OCFram\RuleValidator;
use OCFram\StringField;
use OCFram\RadiosField;
use OCFram\HiddenField;
use OCFram\ChoiceField;
use OCFram\PasswordField;

class NewClientFB extends FormBuilder
{
    public function build()
    {
        $this->form->add(new HiddenField([
            'label' => '',
            'name' => 'id',
            'value' => '',
        ]))
        ->add(new StringField([
            'label' => 'Pseudo',
            'name' => 'pseudo',
            'maxLength' => 15,
            'validators' => [
                new NotNullValidator('Merci de renseigner votre pseudo.'),
                new MaxLengthValidator('Le pseudo est trop long (15 caractères maximum)', 15),
                new MinLengthValidator('Le pseudo est trop court (5 caractères minimum)', 5),
                new RuleValidator('Lettres et chiffres autorisés.', self::RULE_PSEUDO),
            ],
        ]))
        ->add(new PasswordField([
            'label' => 'Mot de passe',
            'name' => 'mdp',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Merci de renseigner un mot de passe.'),
                new MaxLengthValidator('Le mot de passe est trop long (20 caractères maximum)', 20),
                new MinLengthValidator('Le mot de passe est trop court (8 caractères minimum)', 8),
                new RuleValidator('Lettres, chiffres et/ou +@!$%?& autorisés.', self::RULE_MDP),
            ],
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
        ]))
        ->add(new StringField([
            'label' => 'Prenom',
            'name' => 'prenom',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Merci de renseigner un prenom.'),
                new MaxLengthValidator('Le prenom renseigné est trop long (20 caractères maximum)', 20),
                new MinLengthValidator('Le prenom renseigné est trop court (2 caractères minimum)', 2),
                new RuleValidator('Accents, apostrophe, espace et tiret autorisés.', self::RULE_PRENOM),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Email',
            'name' => 'email',
            'maxLength' => 100,
            'validators' => [
                new NotNullValidator('Merci de renseigner votre adresse email.'),
                new MaxLengthValidator('L\'adresse mail renseigné est trop longue (100 caractères maximum)', 100),
                new MinLengthValidator('L\'adresse mail renseigné est trop courte (10 caractères minimum)', 10),
                new RuleValidator('Adresse mail invalide. Format autorisé : toto@domaine.fr - Caractères autorisés : point, underscore et tiret.', self::RULE_MAIL),
            ],
        ]))
        ->add(new RadiosField([
            'label' => 'Genre',
            'name' => 'genre',
        ]))
        ->add(new StringField([
            'label' => 'Ville',
            'name' => 'ville',
            'maxLength' => 100,
            'validators' => [
                new NotNullValidator('Merci de renseigner votre ville.'),
                new MaxLengthValidator('La ville renseignée est trop longue (100 caractères maximum)', 100),
                new MinLengthValidator('La ville renseignée est trop courte (2 caractères minimum)', 2),
                new RuleValidator('Lettres, espace, - et apostrophe autorisés.', self::RULE_VILLE),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Code postal',
            'name' => 'cp',
            'maxLength' => 5,
            'validators' => [
                new NotNullValidator('Merci de renseigner votre code postal.'),
                new MaxLengthValidator('Le code postal renseigné est trop long (5 caractères maximum)', 5),
                new MinLengthValidator('Le code postal renseigné est trop court (5 caractères minimum)', 5),
                new RuleValidator('Le code postal doit contenir 5 numéros.', self::RULE_CP),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Adresse',
            'name' => 'adresse',
            'maxLength' => 100,
            'validators' => [
                new NotNullValidator('Merci de renseigner votre adresse'),
                new MaxLengthValidator('L\'adresse renseignée est trop longue (50 caractères maximum)', 100),
                new MinLengthValidator('L\'adresse renseignée est trop courte (10 caractères minimum)', 10),
                new RuleValidator('Lettres, espace, - et apostrophe autorisés.', self::RULE_ADRESSE),
            ],
        ]))
        ->add(new ChoiceField([
            'label' => 'Newsletter',
            'name' => 'newsletter',
            'multiple' => false,
            'optionsSelected' => [0,1],
            'options' => ['Non inscrit', 'inscrit'],
        ]))
        ->add(new HiddenField([
            'label' => '',
            'name' => 'statut',
            'value' => '0',
        ]));
    }
}