<?php
namespace Model;

use \OCFram\Manager;
use \Entity\DetailsCommande;

class DetailsCommandeManagerPDO extends Manager
{

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id_details_commande, id_commande, id_produit FROM ts_details_commande WHERE id_commande = :id_commande');
    $requete->bindValue(':id_commande', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\DetailsCommande');

    if ($DetailsCommande = $requete->fetch())
    {
      return $DetailsCommande;
    }
    return null;
  }

  public function count($id)
  {
      return $this->dao->query('SELECT COUNT(*) FROM ts_details_commande WHERE id_commande ='.$id)->fetchColumn();
  }

  public function add(DetailsCommande $DetailsCommande)
  {
      $requete = $this->dao->prepare('INSERT INTO ts_details_commande SET id_commande = :id_commande, id_produit = :id_produit');
      $requete->bindValue(':id_commande', $DetailsCommande->getIdCommande(), \PDO::PARAM_INT);
      $requete->bindValue(':id_produit', $DetailsCommande->getIdProduit(), \PDO::PARAM_INT);

      $requete->execute();
  }

  public function update(DetailsCommande $DetailsCommande)
  {
      $requete = $this->dao->prepare('UPDATE ts_details_commande SET id_commande = :id_commande, id_produit = :id_produit WHERE id_details_commande = :id_details_commande');
      $requete->bindValue(':id_commande', $DetailsCommande->getIdCommande(), \PDO::PARAM_INT);
      $requete->bindValue(':id_produit', $DetailsCommande->getIdProduit(), \PDO::PARAM_INT);
      $requete->bindValue(':id_details_commande', $DetailsCommande->getId(), \PDO::PARAM_INT);

      $requete->execute();
  }
 
  public function delete($id)
  {
      $this->dao->exec('DELETE FROM ts_details_commande WHERE id_details_commande = '.(int) $id);
  }


    /**
     * @return mixed
     */
    public function getListById($id)
    {
        $sql = 'SELECT * FROM ts_details_commande WHERE id_commande ='.$id;

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\DetailsCommande');

        $listeDetailsCommandes = $requete->fetchAll();

        $requete->closeCursor();

        return $listeDetailsCommandes;
    }  
}
