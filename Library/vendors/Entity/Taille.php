<?php

namespace Entity;

use OCFram\Entity;

class Taille extends Entity
{
    public $id_taille,
        $nom,
        $prix,
        $description;

    public function isNew()
    {
        return empty($this->id_taille);
    }

    // GETTERS
    public function getId() { return $this->id_taille; }
    public function getNom() { return $this->nom; }
    public function getPrix() { return $this->prix; }
    public function getDescription() { return $this->description; }

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
            $this->id_taille = $id;
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

    /**
     * @param mixed $description
     */
    public function setDescription($description) { $this->description = $description; }

}
