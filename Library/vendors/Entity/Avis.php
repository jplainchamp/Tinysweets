<?php

namespace Entity;

use OCFram\Entity;

class Avis extends Entity
{
    public $id_avis,
        $id_client,
        $id_gateau,
        $commentaire,
        $note,
        $dateAvis;

    public function isNew()
    {
        return empty($this->id_commande);
    }
    
    // GETTERS
    public function getId() { return $this->id_avis; }
    public function getIdClient() { return $this->id_client; }
    public function getIdGateau() { return $this->id_gateau; }
    public function getCommentaire() { return $this->commentaire; }
    public function getNote() { return $this->note; }
    public function getDateAvis() { return $this->dateAvis; }


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
            $this->id_avis = $id;
        }
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    /**
     * @param mixed $id_gateau
     */
    public function setIdGateau($id_gateau)
    {
        $this->id_gateau = $id_gateau;
    }
    
    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }    
    
    /**
     * @param mixed $dateAvis
     */
    public function setDateAvis($dateAvis)
    {
        $this->dateAvis = $dateAvis;
    }


}
    