<?php

namespace Entity;

use OCFram\Entity;

class Commande extends Entity
{
    public $id_commande,
        $montant,
        $dateCommande,
        $dateLivraison,
        $id_client;

    public function isNew()
    {
        return empty($this->id_commande);
    }
    
    // GETTERS
    public function getId() { return $this->id_commande; }
    public function getMontant() { return $this->montant; }
    public function getDateCommande() { return $this->dateCommande; }
    public function getDateLivraison() { return $this->dateLivraison; }
    public function getIdClient() { return $this->id_client; }


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
            $this->id_commande = $id;
        }
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @param mixed $dateCommande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;
    }    
    
    /**
     * @param mixed $dateLivraison
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }
}
    