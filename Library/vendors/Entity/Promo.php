<?php

namespace Entity;

use OCFram\Entity;

class Promo extends Entity
{
    public $id_promo,
        $code_promo,
        $reduction;

    public function isNew()
    {
        return empty($this->id_promo);
    }

    // GETTERS
    public function getId() { return $this->id_promo; }
    public function getCodePromo() { return $this->code_promo; }
    public function getReduction() { return $this->reduction; }

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
            $this->id_promo = $id;
        }
    }

    /**
     * @param mixed $code_promo
     */
    public function setCodePromo($code_promo) { $this->code_promo = $code_promo; }

    /**
     * @param mixed $reduction
     */
    public function setReduction($reduction) { $this->reduction = $reduction; }
    
}
