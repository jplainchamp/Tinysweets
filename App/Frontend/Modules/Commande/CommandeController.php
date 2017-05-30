<?php
namespace App\Frontend\Modules\Commande;

use Entity\Commande;
use Entity\DetailsCommande;
use Entity\Produit;
use \OCFram\BackController;
use \OCFram\HTTPRequest;

class CommandeController extends BackController
{
    public function executeAdd(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Votre panier');
        $gateauId = $request->postData('idGateau');
        $tailleId = $request->postData('idTaille');
        $parfumId = $request->postData('idParfum');
        $promoId = $request->postData('idPromo');
        $quantite = $request->postData('quantite');

        $produit['gateau'] = $this->managers->getManagerOf('Gateau')->getUnique($gateauId);
        $produit['taille'] = $this->managers->getManagerOf('Taille')->getUnique($tailleId);
        $produit['parfum'] = $this->managers->getManagerOf('Parfum')->getUnique($parfumId);
        $produit['promo'] = $this->managers->getManagerOf('Promo')->getUnique($promoId);
        $produit['quantite'] = $quantite;

        $found = false;
        foreach($_SESSION['panier']['produits'] as &$product){
            if($product['gateau'] == $produit['gateau']  && $product['taille'] == $produit['taille'] && $product['parfum'] == $produit['parfum'])
            {
                $found =true;
                $product['quantite'] += $produit['quantite'];

                break;
            }
        }
        if($found === false){
            $_SESSION['panier']['produits'][] = $produit;
            $_SESSION['nbproduits'] += 1;
            $this->app->user()->setFlash('Le gâteau a été ajouté à votre panier', 'success', 'ok');
        } else {
            $this->app->user()->setFlash('Ce gateau est déjà dans votre panier', 'info', 'ok');
        }

        $_SESSION['panier']['total'] += $produit['gateau']->prix * $quantite;
        $_SESSION['panier']['total'] += $produit['taille']->prix * $quantite;
        $_SESSION['panier']['total'] += $produit['parfum']->prix * $quantite;
        $_SESSION['panier']['total'] -= $produit['promo']->reduction * $quantite;
        $this->app->httpResponse()->redirect(ROOTADDRESS.'/panier');

    }

    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Votre panier');
    }

    public function executeDelete(HTTPRequest $request)
    {
        unset($_SESSION['panier']);// supprime le panier
        $_SESSION['panier']['total'] = 0;
        $_SESSION['panier']['produits'] = array();
        $_SESSION['nbproduits']= 0;
        $this->app->user()->setFlash('Votre panier est vide !!', 'info', 'ok');
        $this->app->httpResponse()->redirect(ROOTADDRESS.'/liste_gateaux');
    }

    public function executeDeleteItem(HTTPRequest $request)
    {
        $produitId = $request->getData('id');
        $produit = $_SESSION['panier']['produits'][$produitId];


        if($produit['quantite'] > 1) {
            $_SESSION['panier']['total'] -= $produit['gateau']->prix;
            $_SESSION['panier']['total'] -= $produit['taille']->prix;
            $_SESSION['panier']['total'] -= $produit['parfum']->prix;
            $_SESSION['panier']['total'] += $produit['promo']->reduction;
            $_SESSION['panier']['produits'][$produitId]['quantite'] -= 1;

            $this->app->user()->setFlash('Une quantité '.$produit['gateau']->nom.' a bien été enlevé.', 'success', 'ok');
            $this->app->httpResponse()->redirect(ROOTADDRESS.'/panier');
        } else {
            $quantite = $produit['quantite'];
            $_SESSION['panier']['total'] -= $produit['gateau']->prix * $quantite;
            $_SESSION['panier']['total'] -= $produit['taille']->prix * $quantite;
            $_SESSION['panier']['total'] -= $produit['parfum']->prix * $quantite;
            $_SESSION['panier']['total'] += $produit['promo']->reduction * $quantite;
            unset($_SESSION['panier']['produits'][$produitId]);
            $_SESSION['nbproduits'] -= 1;

            $this->app->user()->setFlash('Le gâteau a bien été supprimé du panier.', 'success', 'ok');
            $this->app->httpResponse()->redirect(ROOTADDRESS.'/panier');
        }
    }

    public function executeDeleteItemAll(HTTPRequest $request)
    {
        $produitId = $request->getData('id');
        $produit = $_SESSION['panier']['produits'][$produitId];
        
        $quantite = $produit['quantite'];
        $_SESSION['panier']['total'] -= $produit['gateau']->prix * $quantite;
        $_SESSION['panier']['total'] -= $produit['taille']->prix * $quantite;
        $_SESSION['panier']['total'] -= $produit['parfum']->prix * $quantite;
        $_SESSION['panier']['total'] += $produit['promo']->reduction * $quantite;
        $_SESSION['nbproduits'] -= 1;
        unset($_SESSION['panier']['produits'][$produitId]);

        $this->app->user()->setFlash('Le gâteau a bien été supprimé du panier.', 'success', 'ok');
        $this->app->httpResponse()->redirect(ROOTADDRESS.'/panier');
    }

    public function executeAddItem(HTTPRequest $request)
    {
        $produitId = $request->getData('id');
        $produit = $_SESSION['panier']['produits'][$produitId];

        $_SESSION['panier']['total'] += $produit['gateau']->prix;
        $_SESSION['panier']['total'] += $produit['taille']->prix;
        $_SESSION['panier']['total'] += $produit['parfum']->prix;
        $_SESSION['panier']['total'] -= $produit['promo']->reduction;
        $_SESSION['panier']['produits'][$produitId]['quantite'] += 1;

        $this->app->user()->setFlash('Une quantité '.$produit['gateau']->nom.' a bien été ajouté.', 'success', 'ok');
        $this->app->httpResponse()->redirect(ROOTADDRESS.'/panier');
    }

    public function executeValidation(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Récapitulatif de votre commande');

        // Insertion dans Table commande
        $objCommande = new Commande();
        $objCommande->setMontant(sprintf('%.2f', ($_SESSION['panier']['total'])* 1.055));
        $objCommande->setIdClient($_SESSION['client']->id_client);
        $objCommande->setDateLivraison($request->postData('dateLivraison'));
        $objCommande->setDateCommande((new \DateTime())->format('Y-m-d H:i:s'));
        $this->managers->getManagerOf('Commande')->add($objCommande);

        //  Insertion dans Table Produit
        foreach( $_SESSION['panier']['produits'] as $produit) {
            $objProduit = new Produit();
            $objProduit->setIdGateau($produit['gateau']->id_gateau);
            $objProduit->setIdParfum($produit['parfum']->id_parfum);
            $objProduit->setIdTaille($produit['taille']->id_taille);
            $objProduit->setIdPromo($produit['promo']->id_promo);
            $objProduit->setQuantite($produit['quantite']);
            $this->managers->getManagerOf('Produit')->add($objProduit);
            //  Insertion dans Table Details_commande
            $objDetailsCommande = new DetailsCommande();

            $idCommande = $this->managers->getManagerOf('Commande')->lastId();
            $idProduit = $this->managers->getManagerOf('Produit')->lastId();

            $objDetailsCommande->setIdProduit($idProduit[0]['lastId']);
            $objDetailsCommande->setIdCommande($idCommande[0]['lastId']);
            $this->managers->getManagerOf('DetailsCommande')->add($objDetailsCommande);
        }

        unset($_SESSION['panier']);// supprime le panier
        $_SESSION['panier']['total'] = 0;
        $_SESSION['panier']['produits'] = array();
        $_SESSION['nbproduits']= 0;

        $this->app->user()->setFlash('Votre commande '.$idCommande[0]['lastId'].' a bien été validée, nous vous en remercions !!', 'success', 'ko');
        $this->app->httpResponse()->redirect(ROOTADDRESS.'/profil');
    }
}