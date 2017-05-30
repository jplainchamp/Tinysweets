<?php
namespace App\Frontend\Modules\Recherche;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class RechercheController extends BackController
{
    public function executeIndex (HTTPRequest $request)
    {
        $this->page->addVar('title', 'Recherche');

        if($request->postExists('idCategorie')) {
            $categorieId = $request->postData('idCategorie');
            $managerGateau = $this->managers->getManagerOf('Gateau');
            $managerPromo = $this->managers->getManagerOf('Promo');
            $this->page->addVar('listeGateaux', $managerGateau->getListCat($categorieId));
            $this->page->addVar('listePromo', $managerPromo->getList());
        }
        
        $managerCategorie = $this->managers->getManagerOf('Categorie');

        $this->page->addVar('listeCategories', $managerCategorie->getList());
    }
}