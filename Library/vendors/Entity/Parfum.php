<?php

namespace Entity;

use OCFram\Entity;

class Parfum extends Entity
{
    public $id_parfum,
        $nom,
        $prix;

    public function isNew()
    {
        return empty($this->id_parfum);
    }

    // GETTERS
    public function getId() { return $this->id_parfum; }
    public function getNom() { return $this->nom; }
    public function getPrix() { return $this->prix; }

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
            $this->id_parfum = $id;
        }
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom) { $this->nom = $nom; }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix) { $this->prix = $prix; }

}
