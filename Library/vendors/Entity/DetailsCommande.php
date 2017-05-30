<?php

namespace Entity;

use OCFram\Entity;

class DetailsCommande extends Entity
{
    public $id_details_commande,
        $id_commande,
        $id_produit;

    public function isNew()
    {
        return empty($this->id_details_commande);
    }
    
    // GETTERS
    public function getId() { return $this->id_details_commande; }
    public function getIdCommande() { return $this->id_commande; }
    public function getIdProduit() { return $this->id_produit; }


    // SETTERS

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int) $id;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->id_details_commande = $id;
        }
    }

    /**
     * @param mixed $id_commande
     */
    public function setIdCommande($id_commande)
    {
        $this->id_commande = $id_commande;
    }
    
    /**
     * @param mixed $id_produit
     */
    public function setIdProduit($id_produit)
    {
        $this->id_produit = $id_produit;
    }
}
    