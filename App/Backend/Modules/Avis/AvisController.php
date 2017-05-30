<?php

namespace App\Backend\Modules\Avis;

use \FormBuilder\AvisFB;
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Avis;

class AvisController extends BackController
{
    public function executeDelete(HTTPRequest $request)
    {
        $avisId = $request->getData('id');

        $this->managers->getManagerOf('Avis')->delete($avisId);

        $this->app->user()->setFlash('L\' avis a bien été supprimé !', 'success', 'ok');

        $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_avis');
    }
    
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Liste des avis');

        $manager = $this->managers->getManagerOf('Avis');

        $this->page->addVar('listeAvis', $manager->getList());
        $this->page->addVar('nombreAvis', $manager->count());

        $managerClient = $this->managers->getManagerOf('Client');
        $this->page->addVar('listeClients', $managerClient->getList());
        $managerGateau = $this->managers->getManagerOf('Gateau');
        $this->page->addVar('listeGateaux', $managerGateau->getList());
    }


    public function executeInsert(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Ajout d\'un avis');
        if ($request->method() == 'POST') {
            $avis = new Avis($_POST);
        } else {
            $avis = new Avis();
        }

        $formBuilder = new AvisFB($avis);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Avis')->add($avis);
            $this->app->user()->setFlash('L\' avis ' . $avis['id_avis'] . ' a bien été ajouté !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_avis');
        }
        $this->page->addVar('form', $form->createView());
    }

}