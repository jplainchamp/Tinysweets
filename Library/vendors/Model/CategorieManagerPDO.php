<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Categorie;

class CategorieManagerPDO extends Manager
{
    /**
     * @return mixed
     */
    public function getList()
  {
    $sql = 'SELECT id_categorie, nom FROM ts_categorie ORDER BY id_categorie ASC';

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Categorie');

      $listeCategorie = $requete->fetchAll();

    $requete->closeCursor();

    return $listeCategorie;
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id_categorie, nom FROM ts_categorie WHERE id_categorie = :id_categorie');
    $requete->bindValue(':id_categorie', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Categorie');

    if ($categorie = $requete->fetch())
    {
      return $categorie;
    }
    return null;
  }

  public function count()
  {
      return $this->dao->query('SELECT COUNT(*) FROM ts_categorie')->fetchColumn();
  }

  public function add(Categorie $categorie)
  {
      $requete = $this->dao->prepare('INSERT INTO ts_categorie SET nom = :nom');
      $requete->bindValue(':nom',$categorie->getNom());

      $requete->execute();
  }

  public function update(Categorie $categorie)
  {
      $requete = $this->dao->prepare('UPDATE ts_categorie SET nom = :nom WHERE id_categorie = :id_categorie');
      $requete->bindValue(':nom',$categorie->getNom());
      $requete->bindValue(':id_categorie', $categorie->getId(), \PDO::PARAM_INT);

      $requete->execute();
  }
 
  public function delete($id)
  {
      $this->dao->exec('DELETE FROM ts_categorie WHERE id_categorie = '.(int) $id);
  }
    
}
