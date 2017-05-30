<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Produit;

class ProduitManagerPDO extends Manager
{
    /**
     * @return mixed
     */
    public function getList()
  {
  $sql = 'SELECT id_produit, id_gateau, id_taille, id_parfum, id_promo, quantite FROM ts_produit ORDER BY id_produit ASC';

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Produit');

      $listeProduits = $requete->fetchAll();

    $requete->closeCursor();

    return $listeProduits;
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id_produit, id_gateau, id_taille, id_parfum, id_promo, quantite FROM ts_produit WHERE id_produit = :id_produit');
    $requete->bindValue(':id_produit', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Produit');

    if ($produit = $requete->fetch())
    {
      return $produit;
    }
    return null;
  }

  public function count()
  {
      return $this->dao->query('SELECT COUNT(*) FROM ts_produit')->fetchColumn();
  }

  public function add(Produit $produit)
  {
      $requete = $this->dao->prepare('INSERT INTO ts_produit SET id_gateau = :id_gateau, id_taille = :id_taille, id_parfum = :id_parfum, id_promo = :id_promo, quantite = :quantite');
      $requete->bindValue(':id_gateau', $produit->getIdGateau(), \PDO::PARAM_INT);
      $requete->bindValue(':id_taille', $produit->getIdTaille(), \PDO::PARAM_INT);
      $requete->bindValue(':id_parfum', $produit->getIdParfum(), \PDO::PARAM_INT);
      $requete->bindValue(':id_promo', $produit->getIdPromo(), \PDO::PARAM_INT);
      $requete->bindValue(':quantite', $produit->getQuantite(), \PDO::PARAM_INT);

      $requete->execute();
  }

  public function lastID()
  {
      $sql = 'SELECT MAX(id_produit) as lastId FROM ts_produit';
      $requete = $this->dao->query($sql);
      $id = $requete->fetchAll();

      return $id;
  }
}
