<?php

namespace OCFram;


class Form
{
    protected $entity; //un attribut stockant l'entité correspondant au formulaire.
    protected $fields = []; //un attribut stockant la liste des champs.

    //un constructeur récupérant l'entité et invoquant le setter correspondant.
    public function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }

    // une méthode permettant d'ajouter un champ à la liste des champs.
    public function add(Field $field)
    {
        $attr = $field->name(); // on récupère le nom du champ.
        $getter = 'get'.ucfirst($attr); // On définit le getter
        $field->setValue($this->entity->$getter()); // On assigne la valeur correspondante au champ.
        $this->fields[] = $field; //On ajoute le champ passé en argument à la liste des champs.
        return $this;
    }

    // une méthode permettant de générer le formulaire.
    public function createView()
    {
        $view = '';

        //on génère un par un les champs du formulaire.
        foreach($this->fields as $field)
        {
            $view .= $field->buildWidget().'<br />';
        }
        return $view;
    }

      // une méthode permettant de vérifier si le formulaire est valide.
      public function isValid()
      {
          $valid = true;

          // on vérifie que tous les champs sont valides.
          foreach($this->fields as $field)
          {
              if(!$field->isValid())
              {
                  $valid = false;
              }
          }
          return $valid;
      }

    public function entity()
    {
        return $this->entity;
    }

    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
    }
}