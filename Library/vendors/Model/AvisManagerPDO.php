<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Avis;

class AvisManagerPDO extends Manager
{
    /**
     * @return mixed
     */
    public function getList()
  {
    $sql = 'SELECT id_avis, id_client, id_gateau, commentaire, note, dateAvis FROM ts_avis ORDER BY id_avis ASC';

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Avis');

      $listeAvis = $requete->fetchAll();

    $requete->closeCursor();

    return $listeAvis;
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id_avis, id_client, id_gateau, commentaire, note, dateAvis FROM ts_avis WHERE id_avis = :id_avis');
    $requete->bindValue(':id_avis', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Avis');

    if ($avis = $requete->fetch())
    {
      return $avis;
    }
    return null;
  }

  public function count()
  {
      return $this->dao->query('SELECT COUNT(*) FROM ts_avis')->fetchColumn();
  }

  public function add(Avis $avis)
  {
      $requete = $this->dao->prepare('INSERT INTO ts_avis SET id_client = :id_client, id_gateau = :id_gateau, commentaire = :commentaire, note = :note, dateAvis = NOW()');
      $requete->bindValue(':id_client', $avis->getIdClient(), \PDO::PARAM_INT);
      $requete->bindValue(':id_gateau', $avis->getIdGateau(), \PDO::PARAM_INT);
      $requete->bindValue(':commentaire',$avis->getCommentaire(), \PDO::PARAM_STR);
      $requete->bindValue(':note', $avis->getNote(), \PDO::PARAM_INT);

      $requete->execute();
  }

  public function update(Avis $avis)
  {
      $requete = $this->dao->prepare('UPDATE ts_avis SET id_client = :id_client, id_gateau = :id_gateau, commentaire = :commentaire, note = :note, dateAvis = :dateAvis WHERE id_avis = :id_avis');
      $requete->bindValue(':id_client', $avis->getIdClient(), \PDO::PARAM_INT);
      $requete->bindValue(':id_gateau', $avis->getIdGateau(), \PDO::PARAM_INT);
      $requete->bindValue(':commentaire',$avis->getCommentaire(), \PDO::PARAM_STR);
      $requete->bindValue(':note', $avis->getNote(), \PDO::PARAM_INT);
      $requete->bindValue(':dateAvis', $avis->getDateAvis(), \PDO::PARAM_STR);
      $requete->bindValue(':id_avis', $avis->getId(), \PDO::PARAM_INT);

      $requete->execute();
  }
 
  public function delete($id)
  {
      $this->dao->exec('DELETE FROM ts_avis WHERE id_avis = '.(int) $id);
  }
   
  public function getAvg($id)
  {
    $requete = $this->dao->prepare('SELECT AVG(note) as moyenne FROM ts_avis WHERE id_gateau='.$id);
    $requete->bindValue(':id_avis', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Avis');

    if ($avis = $requete->fetch())
    {
        return $avis;
    }
    return null;
  }

  public function getCountNote($id)
  {
      return $this->dao->query('SELECT COUNT(note) as nbnote FROM ts_avis WHERE id_gateau='.$id)->fetchColumn();
  }

  public function getCountNoteClient($id1, $id2)
  {
      return $this->dao->query('SELECT COUNT(note) as nbnote FROM ts_avis WHERE id_gateau='.$id1.' AND id_client='.$id2)->fetchColumn();
  }

  public function getListNote($id)
   {
        $sql = 'SELECT id_avis, id_client, id_gateau, commentaire, note, dateAvis, pseudo FROM ts_avis NATURAL JOIN ts_client WHERE ts_client.id_client = ts_avis.id_client AND id_gateau='.$id.' ORDER BY id_avis ASC' ;
    
        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Avis');
    
        $listeNote = $requete->fetchAll();
    
        $requete->closeCursor();
    
        return $listeNote;
   }  
}
