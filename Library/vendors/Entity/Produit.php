<?php

namespace Entity;

use OCFram\Entity;

class Produit extends Entity
{
    public $id_produit,
        $id_gateau,
        $id_taille,
        $id_parfum,
        $id_promo,
        $quantite;

    public function isNew()
    {
        return empty($this->id_produit);
    }

    // GETTERS
    public function getId() { return $this->id_produit; }
    public function getIdGateau() { return $this->id_gateau; }
    public function getIdTaille() { return $this->id_taille; }
    public function getIdParfum() { return $this->id_parfum; }
    public function getIdPromo() { return $this->id_promo; }
    public function getQuantite() { return $this->quantite; }
    
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
            $this->id_produit = $id;
        }
    }

    /**
     * @param mixed $id_gateau
     */
    public function setIdGateau($id_gateau) {
        $id_gateau = (int) $id_gateau;

        if ($id_gateau > 0) {
            $this->id_gateau = $id_gateau;
        }
    }

   /**
   * @param mixed $id_taille
   */
   public function setIdTaille($id_taille) {
        $id_taille = (int) $id_taille;

        if ($id_taille > 0) {
            $this->id_taille = $id_taille;
        }
   }
     
   /**
   * @param mixed $id_parfum
   */
   public function setIdParfum($id_parfum) {
        $id_parfum = (int) $id_parfum;

        if ($id_parfum > 0) {
            $this->id_parfum = $id_parfum;
        }
   }
    
   /**
   * @param mixed $id_promo
   */
   public function setIdPromo($id_promo) {
        $id_promo = (int) $id_promo;

        if ($id_promo > 0) {
            $this->id_promo = $id_promo;
        } 
   }

   /**
   * @param mixed $quantite
   */
   public function setQuantite($quantite) {
        $quantite = (int) $quantite;

        if ($quantite > 0) {
            $this->quantite = $quantite;
        } }
}
