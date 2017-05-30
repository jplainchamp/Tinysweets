<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Gateau;

class GateauManagerPDO extends Manager
{
    /**
     * @return mixed
     */
    public function getList()
  {
     
    $sql = 'SELECT id_gateau, nom, prix, description, photo, id_categorie, id_promo FROM ts_gateau ORDER BY id_gateau ASC';
      
    $requete = $this->dao->query($sql);

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Gateau');

      $listeGateaux = $requete->fetchAll();

    $requete->closeCursor();

    return $listeGateaux;
  }

    /**
     * @return mixed
     */
    public function getListCat($id)
    {

        $sql = 'SELECT id_gateau, nom, prix, description, photo, id_categorie, id_promo FROM ts_gateau WHERE id_categorie ='.$id ;

        $requete = $this->dao->query($sql);

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Gateau');

        $listeGateaux = $requete->fetchAll();

        $requete->closeCursor();

        return $listeGateaux;
    }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id_gateau, nom, prix, description, photo, id_categorie, id_promo FROM ts_gateau WHERE id_gateau = :id_gateau');
    $requete->bindValue(':id_gateau', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Gateau');

    if ($gateau = $requete->fetch())
    {
      return $gateau;
    }
    return null;
  }

  public function count()
  {
      return $this->dao->query('SELECT COUNT(*) FROM ts_gateau')->fetchColumn();
  }

  public function add(Gateau $gateau)
  {
      $requete = $this->dao->prepare('INSERT INTO ts_gateau SET nom = :nom, prix = :prix, description = :description, photo = :photo, id_categorie = :id_categorie, id_promo = :id_promo');
      $requete->bindValue(':nom',$gateau->getNom(), \PDO::PARAM_STR);
      $requete->bindValue(':prix', $gateau->getPrix(), \PDO::PARAM_INT);
      $requete->bindValue(':description', $gateau->getDescription(), \PDO::PARAM_STR);
      $requete->bindValue(':photo', $gateau->getPhoto(), \PDO::PARAM_STR);
      $requete->bindValue(':id_categorie', $gateau->getIdCategorie(), \PDO::PARAM_INT);
      $requete->bindValue(':id_promo', $gateau->getIdPromo(), \PDO::PARAM_INT);

      $requete->execute();
  }

  public function update(Gateau $gateau)
  {
      $requete = $this->dao->prepare('UPDATE ts_gateau SET nom = :nom, prix = :prix, description = :description, photo = :photo, id_categorie = :id_categorie, id_promo = :id_promo WHERE id_gateau = :id_gateau');
      $requete->bindValue(':nom',$gateau->getNom(), \PDO::PARAM_STR);
      $requete->bindValue(':prix', $gateau->getPrix(), \PDO::PARAM_INT);
      $requete->bindValue(':description', $gateau->getDescription(), \PDO::PARAM_STR);
      $requete->bindValue(':photo', $gateau->getPhoto(), \PDO::PARAM_STR);
      $requete->bindValue(':id_categorie', $gateau->getIdCategorie(), \PDO::PARAM_INT);
      $requete->bindValue(':id_promo', $gateau->getIdPromo(), \PDO::PARAM_INT);
      $requete->bindValue(':id_gateau', $gateau->getId(), \PDO::PARAM_INT);

      $requete->execute();
  }
 
  public function delete($id)
  {
      $this->dao->exec('DELETE FROM ts_gateau WHERE id_gateau = '.(int) $id);
  }
    
}
