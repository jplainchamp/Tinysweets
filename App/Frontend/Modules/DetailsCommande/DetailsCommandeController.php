<?php

namespace App\Frontend\Modules\DetailsCommande;

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
        $managerProduit = $this->managers->getManagerOf('Produit');
        //$client = $this->managers->getManagerOf('Client')->getList($request->getData('id_client'));

        $this->page->addVar('DetailsCommande', $manager->getUnique($DetailsCommandeId));
        $this->page->addVar('nombreDetailsCommandes', $manager->count($DetailsCommandeId));
    }

}