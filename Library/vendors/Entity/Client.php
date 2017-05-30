<?php
namespace Entity;

use \OCFram\Entity;

class Client extends Entity
{
  public $id_client,
        $pseudo,
        $mdp,
        $nom,
        $prenom,
        $email,
        $genre,
        $ville,
        $cp,
        $adresse,
        $statut,
        $newsletter;
    
  public function isNew()
  {
    return empty($this->id_client);
  }
  
  // GETTERS
    public function getId() { return $this->id_client; }
    public function getPseudo() { return $this->pseudo; }
    public function getMdp() { return $this->mdp; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail() { return $this->email; }
    public function getGenre() { return $this->genre; }
    public function getVille() { return $this->ville; }
    public function getCp() { return $this->cp; }
    public function getAdresse() { return $this->adresse; }
    public function getStatut() { return $this->statut; }
    public function getNewsletter() { return $this->newsletter; }

    // SETTERS

    /**
     * @param mixed $id_client
     */
    public function setId($id)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id= (int) $id;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0)
        {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->id_client = $id;
        }
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo) { $this->pseudo = $pseudo; }

    /**
     * @param mixed $mdp
     */
    public function setMdp($mdp) { $this->mdp = $mdp; }

    /**
     * @param $nom
     * @internal param mixed $nom
     */
    public function setNom($nom) { $this->nom = $nom; }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom) { $this->prenom = $prenom; }

    /**
     * @param mixed $email
     */
    public function setEmail($email) { if (filter_var($email, FILTER_VALIDATE_EMAIL)) $this->email = $email; }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre) {  $this->genre = $genre; }

    /**
     * @param mixed $ville
     */
    public function setVille($ville) { $this->ville = $ville; }

    /**
     * @param mixed $cp
     */
    public function setCp($cp) { $this->cp = $cp; }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse) { $this->adresse = $adresse; }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut) { $this->statut = $statut; }

    /**
     * @param mixed $newsletter
     */
    public function setNewsletter($newsletter) { $this->newsletter = $newsletter; }
}
