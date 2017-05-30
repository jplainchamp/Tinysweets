<?php
namespace OCFram;

abstract class FormBuilder
{
    const RULE_PSEUDO = '/^[a-zA-Z0-9]{5,15}$/';
    const RULE_MDP = '/^[a-zA-Z0-9+@!$%?&]{8,20}$/';
    const RULE_NOM = '/^[a-zA-Zàáâãäòóôõöèéêëçíîïùúûüÿ \' -]{2,20}$/';
    const RULE_PRENOM = '/^[a-zA-Zàáâãäòóôõöèéêëçíîïùúûüÿ \' -]{2,20}$/';
    const RULE_TAILLE = '/^[a-zA-Zàáâãäòóôõöèéêëçíîïùúûüÿ \' -]{1,20}$/';
    const RULE_PARFUM = '/^[a-zA-Zàáâãäòóôõöèéêëçíîïùúûüÿ \' -]{5,50}$/';
    const RULE_MAIL = '/^[a-z0-9.-]+@[a-z0-9.-]{2,}\.[a-z]{2,4}$/';
    const RULE_VILLE = '/^[a-zA-Zàáâãäòóôõöèéêëçíîïùúûüÿ \' -]{2,100}$/';
    const RULE_COMMENTAIRE = '/^[a-zA-Z0-9àáâãäòóôõöèéêëçíîïùúûüÿ \' -!?,.]{2,255}$/';
    const RULE_CP = '/^[0-9]{5,5}$/';
    const RULE_ADRESSE = '/^[a-zA-Z0-9àáâãäòóôõöèéêëçíîïùúûüÿñ \'-]{10,100}$/';
    const RULE_PRIX = '/^[0-9]{2,5}$/';
    const RULE_PROMO = '/^[0-9]{1,3}$/';
    const RULE_NOTE = '/^[0-5]{1,1}$/';
    //const RULE_TEXTE = '/^[a-zA-Z0-9àáâãäòóôõöèéêëçíîïùúûüÿñ.!?-_ \'-]{5,255}$/';
    const RULE_DATE = '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/';
    const RULE_DATECOURTE = '/^\d{4}-\d{2}-\d{2}$/';

    protected $form;

    public function __construct(Entity $entity)
    {
        $this->setForm(new Form($entity));
    }

    abstract public function build();

    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    public function form()
    {
        return $this->form;
    }
}