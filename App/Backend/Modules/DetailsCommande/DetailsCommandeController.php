<?php

namespace App\Backend\Modules\DetailsCommande;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\DetailsCommande;
use \Entity\Produit;

class DetailsCommandeController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Liste des commandes détaillées');
        
        $DetailsCommandeId = $request->getData('id');

        $manager = $this->managers->getManagerOf('DetailsCommande');
        $produit = $this->managers->getManagerOf('Produit');
        $gateau = $this->managers->getManagerOf('Gateau');
        $taille = $this->managers->getManagerOf('Taille');
        $parfum = $this->managers->getManagerOf('Parfum');
        $promo = $this->managers->getManagerOf('Promo');

        $this->page->addVar('DetailsCommande', $manager->getUnique($DetailsCommandeId));
        $this->page->addVar('nombreDetailsCommandes', $manager->count($DetailsCommandeId));
        $this->page->addVar('gateau', $gateau->getUnique($gateau));
    }

}