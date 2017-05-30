<?php

namespace Entity;

use OCFram\Entity;

class Gateau extends Entity
{
    public $id_gateau,
        $nom,
        $prix,
        $description,
        $photo,
        $id_categorie,
        $id_promo;

    public function isNew()
    {
        return empty($this->id_gateau);
    }

    // GETTERS
    public function getId() { return $this->id_gateau; }
    public function getNom() { return $this->nom; }
    public function getPrix() { return $this->prix; }
    public function getDescription() { return $this->description; }
    public function getPhoto() { return $this->photo; }
    public function getIdCategorie() { return $this->id_categorie; }
    public function getIdPromo() { return $this->id_promo; }



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
            $this->id_gateau = $id;
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

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo) { $this->photo = $photo; }
    
    /**
     * @param mixed $id_categorie
     */
    public function setIdCategorie($id_categorie) {
        $id_categorie = (int) $id_categorie;

        if ($id_categorie > 0) {
            $this->id_categorie = $id_categorie;
        }
    }

    /**
     * @param mixed $id_promo
     */
    public function setIdPromo($id_promo) {
        $id_promo = (int) $id_promo;

        if ($id_promo > 0) {
            $this->id_promo = $id_promo;
        } }

}
