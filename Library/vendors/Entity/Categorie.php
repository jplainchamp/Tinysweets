<?php

namespace Entity;

use OCFram\Entity;

class Categorie extends Entity
{
    public $id_categorie,
        $nom;

    public function isNew()
    {
        return empty($this->id_categorie);
    }

    // GETTERS
    public function getId() { return $this->id_categorie; }
    public function getNom() { return $this->nom; }

    // SETTERS

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$id;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->id_categorie = $id;
        }
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom) { $this->nom = $nom; }
    
}
