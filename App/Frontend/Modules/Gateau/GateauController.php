<?php
namespace App\Frontend\Modules\Gateau;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Avis;
use \FormBuilder\AddAvisFB;

class GateauController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'TINY SWEETS');
     
        $managerGateau = $this->managers->getManagerOf('Gateau');
        $managerPromo = $this->managers->getManagerOf('Promo');
        $managerTaille = $this->managers->getManagerOf('Taille');
        $managerParfum = $this->managers->getManagerOf('Parfum');
        
        $this->page->addVar('listeGateaux', $managerGateau->getList());
        $this->page->addVar('listePromo', $managerPromo->getList());
        $this->page->addVar('listeTaille', $managerTaille->getList());
        $this->page->addVar('listeParfum', $managerParfum->getList());
 
    }
        public function executeListe(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Nos gâteaux');
        $managerGateau = $this->managers->getManagerOf('Gateau');
        $managerPromo = $this->managers->getManagerOf('Promo');
        $managerTaille = $this->managers->getManagerOf('Taille');
        $managerParfum = $this->managers->getManagerOf('Parfum');

        $this->page->addVar('listeGateaux', $managerGateau->getList());
        $this->page->addVar('listePromo', $managerPromo->getList());
        $this->page->addVar('listeTaille', $managerTaille->getList());
        $this->page->addVar('listeParfum', $managerParfum->getList());
    }
    
    public function executeFiche (HTTPRequest $request)
    {
        $this->page->addVar('title', 'Fiche détaillée');

        $gateauId = $request->getData('id');
        $clientId = $_SESSION['client']->id_client;

        $managerGateau = $this->managers->getManagerOf('Gateau');
        $managerPromo = $this->managers->getManagerOf('Promo');
        $managerTaille = $this->managers->getManagerOf('Taille');
        $managerParfum = $this->managers->getManagerOf('Parfum');
        $managerAvis = $this->managers->getManagerOf('Avis');
        $managerCategorie = $this->managers->getManagerOf('Categorie');

        $this->page->addVar('gateau', $managerGateau->getUnique($gateauId));
        $this->page->addVar('noteMoyenne', $managerAvis->getAvg($gateauId));
        $this->page->addVar('nombreNote', $managerAvis->getCountNote($gateauId));
        $this->page->addVar('clientNote', $managerAvis->getCountNoteClient($gateauId,$clientId));
        $this->page->addVar('listeNote', $managerAvis->getListNote($gateauId));
        $this->page->addVar('listePromo', $managerPromo->getList());
        $this->page->addVar('listeTaille', $managerTaille->getList());
        $this->page->addVar('listeParfum', $managerParfum->getList());
        $this->page->addVar('listeCategorie', $managerCategorie->getList());

        if ($request->method() == 'POST') {
            $avis = new Avis($_POST);
        } else {
            $avis = new Avis();
        }

        $formBuilder = new AddAvisFB($avis);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            var_dump($avis, $_POST);
            $this->managers->getManagerOf('Avis')->add($avis);
            $this->app->user()->setFlash('L\' avis ' . $avis['id_avis'] . ' a bien été ajouté !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/fiche-'.$gateauId);
        }
        $this->page->addVar('form', $form->createView());
    }
}