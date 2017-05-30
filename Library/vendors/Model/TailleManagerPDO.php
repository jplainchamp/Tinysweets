<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Taille;

class TailleManagerPDO extends Manager
{
    /**
     * @return mixed
     */
    public function getList()
  {
    $sql = 'SELECT id_taille, nom, prix, description FROM ts_taille ORDER BY id_taille ASC';

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Taille');

      $listeTaille = $requete->fetchAll();

    $requete->closeCursor();

    return $listeTaille;
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id_taille, nom, prix, description FROM ts_taille WHERE id_taille = :id_taille');
    $requete->bindValue(':id_taille', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Taille');

    if ($taille = $requete->fetch())
    {
      return $taille;
    }
    return null;
  }

  public function count()
  {
      return $this->dao->query('SELECT COUNT(*) FROM ts_taille')->fetchColumn();
  }

  public function add(Taille $taille)
  {
      $requete = $this->dao->prepare('INSERT INTO ts_taille SET nom = :nom, prix = :prix, description = :description');
      $requete->bindValue(':nom',$taille->getNom(), \PDO::PARAM_STR);
      $requete->bindValue(':prix', $taille->getPrix(), \PDO::PARAM_INT);
      $requete->bindValue(':description', $taille->getDescription(), \PDO::PARAM_STR);

      $requete->execute();
  }

  public function update(Taille $taille)
  {
      $requete = $this->dao->prepare('UPDATE ts_taille SET nom = :nom, prix = :prix, description = :description WHERE id_taille = :id_taille');
      $requete->bindValue(':nom',$taille->getNom(), \PDO::PARAM_STR);
      $requete->bindValue(':prix', $taille->getPrix(), \PDO::PARAM_INT);
      $requete->bindValue(':description', $taille->getDescription(), \PDO::PARAM_STR);
      $requete->bindValue(':id_taille', $taille->getId(), \PDO::PARAM_INT);

      $requete->execute();
  }
 
  public function delete($id)
  {
      $this->dao->exec('DELETE FROM ts_taille WHERE id_taille = '.(int) $id);
  }
    
}
