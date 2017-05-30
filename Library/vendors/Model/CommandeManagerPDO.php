<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Commande;
//use \Entity\Client;

class CommandeManagerPDO extends Manager
{
  /**
  * @return mixed
  */
  public function getList()
  {
  $sql = 'SELECT id_commande, montant, dateCommande, dateLivraison, id_client FROM ts_commande ORDER BY id_commande ASC';

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commande');

      $listeCommandes = $requete->fetchAll();

    $requete->closeCursor();

    return $listeCommandes;
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id_commande, montant, dateCommande, dateLivraison, id_client FROM ts_commande WHERE id_commande = :id_commande');
    $requete->bindValue(':id_commande', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commande');

    if ($commande = $requete->fetch())
    {
      return $commande;
    }
    return null;
  }

  public function count()
  {
      return $this->dao->query('SELECT COUNT(*) FROM ts_commande')->fetchColumn();
  }

  public function add(Commande $commande)
  {
      $requete = $this->dao->prepare('INSERT INTO ts_commande SET montant = :montant, dateCommande = :dateCommande, dateLivraison = :dateLivraison, id_client = :id_client');
      $requete->bindValue(':montant', $commande->getMontant(), \PDO::PARAM_INT);
      $requete->bindValue(':dateCommande', $commande->getDateCommande(), \PDO::PARAM_STR);
      $requete->bindValue(':dateLivraison', $commande->getDateLivraison(), \PDO::PARAM_STR);
      $requete->bindValue(':id_client', $commande->getIdClient(), \PDO::PARAM_INT);

      $requete->execute();
  }

  public function update(Commande $commande)
  {
      $requete = $this->dao->prepare('UPDATE ts_commande SET montant = :montant, dateCommande = :dateCommande, dateLivraison = :dateLivraison WHERE id_commande = :id_commande');
      $requete->bindValue(':montant', $commande->getMontant(), \PDO::PARAM_INT);
      $requete->bindValue(':dateCommande', $commande->getDateCommande(), \PDO::PARAM_STR);
      $requete->bindValue(':dateLivraison', $commande->getDateLivraison(), \PDO::PARAM_STR);
      $requete->bindValue(':id_commande', $commande->getId(), \PDO::PARAM_INT);

      $requete->execute();
  }
 
  public function delete($id)
  {
      $this->dao->exec('DELETE FROM ts_commande WHERE id_commande = '.(int) $id);
  }
  
  
  public function lastId()
  {
        $sql = 'SELECT MAX(id_commande) as lastId FROM ts_commande';
        $requete = $this->dao->query($sql);
        $id = $requete->fetchAll();

        return $id;
  }

  public function lastIdByClient($id)
  {
        $sql = 'SELECT MAX(id_commande) as lastId FROM ts_commande WHERE id_client ='.$id;
        $requete = $this->dao->query($sql);
        $id = $requete->fetchAll();

        return $id;
  }

  /**
  * @return mixed 
  */
  public function getListbyId($id)
  {
        $sql = 'SELECT id_commande, montant, dateCommande, dateLivraison, id_client FROM ts_commande WHERE id_client = '.$id;

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commande');

        $listeCommandes = $requete->fetchAll();

        $requete->closeCursor();

        return $listeCommandes;
  }  
}
