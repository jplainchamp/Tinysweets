<?php

namespace App\Backend\Modules\Gateau;

use \FormBuilder\GateauFB;
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Gateau;

class GateauController extends BackController
{
    public function executeDelete(HTTPRequest $request)
    {
        $gateauId = $request->getData('id');

        $this->managers->getManagerOf('Gateau')->delete($gateauId);

        $this->app->user()->setFlash('Le gâteau a bien été supprimé !', 'success', 'ok');

        $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_gateaux');
    }

    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Liste des Gâteaux');

        $manager = $this->managers->getManagerOf('Gateau');

        $this->page->addVar('listeGateaux', $manager->getList());
        $this->page->addVar('nombreGateaux', $manager->count());
    }

    /**
     * @param HTTPRequest $request
     */
    public function executeUpdate(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Modification d\'un gâteau');
        
        if ($request->method() == 'POST') {
            $gateau = new Gateau($_POST);

            if(!empty($_FILES['photo']['name'])) {
                $nom_photo = $_FILES['photo']['name'];
                $gateau->photo = "/tinysweets2/Web/photos/$nom_photo";
            }
        } else {
            $gateau = $this->managers->getManagerOf('Gateau')->getUnique($request->getData('id'));
        }
        $formBuilder = new GateauFB($gateau);
        $formBuilder->build();
        $form = $formBuilder->form();

        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Gateau')->update($gateau);
            $this->app->user()->setFlash('Le gâteau ' . $gateau->nom . ' a bien été modifié !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_gateaux');
        }
        $this->page->addVar('form', $form->createView());
    }

    public function executeInsert(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Ajout d\'un gâteau');
        if ($request->method() == 'POST') {
            $gateau = new Gateau($_POST);
            if(!empty($_FILES['photo']['name'])) {
                $nom_photo = $_FILES['photo']['name'];
                $gateau->photo = "/tinysweets2/Web/photos/$nom_photo";
            }
        } else {
            $gateau = new Gateau();
        }

        $formBuilder = new GateauFB($gateau);
        $formBuilder->build();
        $form = $formBuilder->form();
        
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Gateau')->add($gateau);
            $this->app->user()->setFlash('Le gâteau ' . $gateau->nom . ' a bien été ajouté !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_gateaux');
        }
        $this->page->addVar('form', $form->createView());
    }

}