<?php

namespace App\Backend\Modules\Taille;

use \FormBuilder\TailleFB;
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Taille;

class TailleController extends BackController
{
    public function executeDelete(HTTPRequest $request)
    {
        $tailleId = $request->getData('id');

        $this->managers->getManagerOf('Taille')->delete($tailleId);

        $this->app->user()->setFlash('La taille a bien été supprimée !', 'success', 'ok');

        $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_tailles');
    }
    
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Liste des tailles');

        $manager = $this->managers->getManagerOf('Taille');

        $this->page->addVar('listeTaille', $manager->getList());
        $this->page->addVar('nombreTaille', $manager->count());
    }

    /**
     * @param HTTPRequest $request
     */
    public function executeUpdate(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Modification d\'une taille');

        if ($request->method() == 'POST')
        {
            $taille = new Taille($_POST);
        } else {
            $taille = $this->managers->getManagerOf('Taille')->getUnique($request->getData('id'));
        }

        $formBuilder = new TailleFB($taille);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Taille')->update($taille);
            $this->app->user()->setFlash('La taille ' . $taille['id_taille'] . ' a bien été modifiée !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_tailles');
        }
        $this->page->addVar('form', $form->createView());
    }

    public function executeInsert(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Ajout d\'une taille');
        if ($request->method() == 'POST') {
            $taille = new Taille($_POST);
        } else {
            $taille = new Taille();
        }

        $formBuilder = new TailleFB($taille);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Taille')->add($taille);
            $this->app->user()->setFlash('La taille ' . $taille['id_taille'] . ' a bien été ajoutée !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_tailles');
        }
        $this->page->addVar('form', $form->createView());
    }

}