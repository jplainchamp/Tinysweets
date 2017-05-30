<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Parfum;

class ParfumManagerPDO extends Manager
{
    /**
     * @return mixed
     */
    public function getList()
  {
    $sql = 'SELECT id_parfum, nom, prix FROM ts_parfum ORDER BY id_parfum ASC';

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Parfum');

      $listeParfum = $requete->fetchAll();

    $requete->closeCursor();

    return $listeParfum;
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id_parfum, nom, prix FROM ts_parfum WHERE id_parfum = :id_parfum');
    $requete->bindValue(':id_parfum', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Parfum');

    if ($parfum = $requete->fetch())
    {
      return $parfum;
    }
    return null;
  }

  public function count()
  {
      return $this->dao->query('SELECT COUNT(*) FROM ts_parfum')->fetchColumn();
  }

  public function add(Parfum $parfum)
  {
      $requete = $this->dao->prepare('INSERT INTO ts_parfum SET nom = :nom, prix = :prix');
      $requete->bindValue(':nom',$parfum->getNom(), \PDO::PARAM_STR);
      $requete->bindValue(':prix', $parfum->getPrix(), \PDO::PARAM_INT);

      $requete->execute();
  }

  public function update(Parfum $parfum)
  {
      $requete = $this->dao->prepare('UPDATE ts_parfum SET nom = :nom, prix = :prix WHERE id_parfum = :id_parfum');
      $requete->bindValue(':nom',$parfum->getNom(), \PDO::PARAM_STR);
      $requete->bindValue(':prix', $parfum->getPrix(), \PDO::PARAM_INT);
      $requete->bindValue(':id_parfum', $parfum->getId(), \PDO::PARAM_INT);

      $requete->execute();
  }
 
  public function delete($id)
  {
      $this->dao->exec('DELETE FROM ts_parfum WHERE id_parfum = '.(int) $id);
  }
    
}
