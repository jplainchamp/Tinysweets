<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Promo;

class PromoManagerPDO extends Manager
{
    /**
     * @return mixed
     */
    public function getList()
  {
    $sql = 'SELECT id_promo, code_promo, reduction FROM ts_promotion ORDER BY id_promo ASC';

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Promo');

      $listePromo = $requete->fetchAll();

    $requete->closeCursor();

    return $listePromo;
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id_promo, code_promo, reduction FROM ts_promotion WHERE id_promo = :id_promo');
    $requete->bindValue(':id_promo', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Promo');

    if ($promo = $requete->fetch())
    {
      return $promo;
    }
    return null;
  }

  public function count()
  {
      return $this->dao->query('SELECT COUNT(*) FROM ts_promotion')->fetchColumn();
  }

  public function add(Promo $promo)
  {
      $requete = $this->dao->prepare('INSERT INTO ts_promotion SET code_promo = :code_promo, reduction = :reduction');
      $requete->bindValue(':code_promo',$promo->getCodePromo(), \PDO::PARAM_STR);
      $requete->bindValue(':reduction', $promo->getReduction(), \PDO::PARAM_INT);

      $requete->execute();
  }

  public function update(Promo $promo)
  {
      $requete = $this->dao->prepare('UPDATE ts_promotion SET code_promo = :code_promo, reduction = :reduction WHERE id_promo = :id_promo');
      $requete->bindValue(':code_promo',$promo->getCodePromo(), \PDO::PARAM_STR);
      $requete->bindValue(':reduction', $promo->getReduction(), \PDO::PARAM_INT);
      $requete->bindValue(':id_promo', $promo->getId(), \PDO::PARAM_INT);

      $requete->execute();
  }
 
  public function delete($id)
  {
      $this->dao->exec('DELETE FROM ts_promotion WHERE id_promo = '.(int) $id);
  }
    
}
