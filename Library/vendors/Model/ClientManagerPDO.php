<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Client;

class ClientManagerPDO extends Manager
{
    /**
     * @return mixed
     */
    public function getList()
  {
    $sql = 'SELECT id_client, pseudo, mdp, nom, prenom, email, genre, ville, cp, adresse, statut, newsletter FROM ts_client ORDER BY id_client ASC';

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Client');

      $listeClients = $requete->fetchAll();

    $requete->closeCursor();

    return $listeClients;
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id_client, pseudo, nom, prenom, email, genre, ville, cp, adresse, statut, newsletter FROM ts_client WHERE id_client = :id_client');
    $requete->bindValue(':id_client', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Client');

    if ($client = $requete->fetch())
    {
      return $client;
    }
    return null;
  }

  public function count()
  {
      return $this->dao->query('SELECT COUNT(*) FROM ts_client')->fetchColumn();
  }

  public function add(Client $client)
  {
      $requete = $this->dao->prepare('INSERT INTO ts_client SET pseudo = :pseudo, mdp = :mdp, nom = :nom, prenom = :prenom, email = :email, genre = :genre, ville = :ville, cp = :cp, adresse = :adresse, statut = :statut, newsletter = :newsletter');
      $requete->bindValue(':pseudo', $client->getPseudo());
      $requete->bindValue(':mdp', password_hash($client->getMdp(), PASSWORD_BCRYPT));
      $requete->bindValue(':nom', $client->getNom());
      $requete->bindValue(':prenom', $client->getPrenom());
      $requete->bindValue(':email', $client->getEmail());
      $requete->bindValue(':genre', $client->getGenre());
      $requete->bindValue(':ville', $client->getVille());
      $requete->bindValue(':cp', $client->getCp());
      $requete->bindValue(':adresse', $client->getAdresse());
      $requete->bindValue(':statut', $client->getStatut());
      $requete->bindValue(':newsletter', $client->getNewsletter());

      $requete->execute();
  }

  public function update(Client $client)
  {
      $requete = $this->dao->prepare('UPDATE ts_client SET pseudo = :pseudo, nom = :nom, prenom = :prenom, email = :email, genre = :genre, ville = :ville, cp = :cp, adresse = :adresse, statut = :statut, newsletter = :newsletter WHERE id_client = :id_client');
      $requete->bindValue(':pseudo', $client->getPseudo());
      $requete->bindValue(':nom', $client->getNom());
      $requete->bindValue(':prenom', $client->getPrenom());
      $requete->bindValue(':email', $client->getEmail());
      $requete->bindValue(':genre', $client->getGenre());
      $requete->bindValue(':ville', $client->getVille());
      $requete->bindValue(':cp', $client->getCp());
      $requete->bindValue(':adresse', $client->getAdresse());
      $requete->bindValue(':statut', $client->getStatut());
      $requete->bindValue(':newsletter', $client->getNewsletter());
      $requete->bindValue(':id_client', $client->getId(), \PDO::PARAM_INT);

      $requete->execute();
  }
 
  public function delete($id)
  {
      $this->dao->exec('DELETE FROM ts_client WHERE id_client = '.(int) $id);
  }

  public function getClient($pseudo)
 {
    $requete = $this->dao->prepare('SELECT id_client, pseudo, mdp, nom, prenom, email, genre, ville, cp, adresse, statut, newsletter FROM ts_client WHERE pseudo = :pseudo');
    $requete->bindValue(':pseudo', (string) $pseudo, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Client');

    if ($client = $requete->fetch())
    {
        return $client;
    }
    return null;
 }

 public function getInfosByMail($email)
 {
    $requete = $this->dao->prepare('SELECT id_client, pseudo, mdp, email FROM ts_client WHERE email = :email');
    $requete->bindValue(':email', (string) $email, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Client');

    if ($client = $requete->fetch())
    {
        return $client;
    }
    return null;
 }
    public function modifyMdp($mdp, $id)
    {
        $requete = $this->dao->prepare('UPDATE ts_client SET mdp = :mdp WHERE id_client = :id_client');
        $requete->bindValue(':mdp', password_hash($mdp, PASSWORD_BCRYPT));
        $requete->bindValue(':id_client', $id, \PDO::PARAM_INT);

        $requete->execute();
    }
}
