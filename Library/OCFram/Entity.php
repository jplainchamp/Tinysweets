<?php
namespace OCFram;

abstract class Entity implements \ArrayAccess
{
  protected $erreurs = [],
            $id;
  // Utilisation du trait Hydrator pour que nos entités puissent être hydratées
  use Hydrator;
  // La méthode hydrate() n'est ainsi plus implémentée dans notre classe
  public function __construct(array $donnees = [])
  {
    if (!empty($donnees))
    {
      $this->hydrate($donnees);
    }
  }

  /********************** METHODES **********************/

  /**
   * Méthode qui vérifie si l'id est non null, ce qui signifie que l'entité n'est pas nouvelle
   * Permet de savoir si on doit faire une UPDATE ou INSERT par exemple
   */
  abstract public function isNew();

  /********************** GETTERS **********************/

  abstract public function getId();
  
  /********************** SETTERS **********************/
  
  public function erreurs()
  {
    return $this->erreurs;
  }
    
  public function setId($id)
  {
    $this->id = (int) $id;
  }

  public function offsetGet($var)
  {
    if (isset($this->$var) && is_callable([$this, $var]))
    {
      return $this->$var();
    }
  }

  public function offsetSet($var, $value)
  {
    $method = 'set'.ucfirst($var);

    if (isset($this->$var) && is_callable([$this, $method]))
    {
      $this->$method($value);
    }
  }

  public function offsetExists($var)
  {
    return isset($this->$var) && is_callable([$this, $var]);
  }

  public function offsetUnset($var)
  {
    throw new \Exception('Impossible de supprimer une quelconque valeur');
  }
}
