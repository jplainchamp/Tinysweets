<?php

namespace App\Backend\Modules\Parfum;

use \FormBuilder\ParfumFB;
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Parfum;

class ParfumController extends BackController
{
    public function executeDelete(HTTPRequest $request)
    {
        $categorieId = $request->getData('id');

        $this->managers->getManagerOf('Parfum')->delete($categorieId);

        $this->app->user()->setFlash('Le parfum a bien été supprimé !', 'success', 'ok');

        $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_parfums');
    }
    
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Liste des parfums');

        $manager = $this->managers->getManagerOf('Parfum');

        $this->page->addVar('listeParfum', $manager->getList());
        $this->page->addVar('nombreParfum', $manager->count());
    }

    /**
     * @param HTTPRequest $request
     */
    public function executeUpdate(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Modification d\'un parfum');

        if ($request->method() == 'POST')
        {
            $parfum = new Parfum($_POST);
        } else {
            $parfum = $this->managers->getManagerOf('Parfum')->getUnique($request->getData('id'));
        }

        $formBuilder = new ParfumFB($parfum);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Parfum')->update($parfum);
            $this->app->user()->setFlash('Le parfum ' . $parfum['id_parfum'] . ' a bien été modifié !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_parfums');
        }
        $this->page->addVar('form', $form->createView());
    }

    public function executeInsert(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Ajout d\'un parfum');
        if ($request->method() == 'POST') {
            $parfum = new Parfum($_POST);
        } else {
            $parfum = new Parfum();
        }

        $formBuilder = new ParfumFB($parfum);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Parfum')->add($parfum);
            $this->app->user()->setFlash('Le parfum ' . $parfum['id_parfum'] . ' a bien été ajouté !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_parfums');
        }
        $this->page->addVar('form', $form->createView());
    }

}