<?php

namespace App\Backend\Modules\Commande;

use FormBuilder\CommandeFB;
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Commande;

class CommandeController extends BackController
{
    public function executeDelete(HTTPRequest $request)
    {

        $commandeId = $request->getData('id');
        $this->managers->getManagerOf('Commande')->delete($commandeId);
        
        $this->app->user()->setFlash('La commande a bien été supprimée !', 'success', 'ok');

        $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_commandes');
    }

    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Liste des commandes');

        $manager = $this->managers->getManagerOf('Commande');
        //$client = $this->managers->getManagerOf('Client')->getList($request->getData('id_client'));

        $this->page->addVar('listeCommandes', $manager->getList());
        $this->page->addVar('nombreCommandes', $manager->count());
    }

    /**
     * @param HTTPRequest $request
     */
    public function executeUpdate(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Modification d\'une commande');

    }

    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST')
        {
            $commande = new Commande($_POST);
        } else {
            $commande = $this->managers->getManagerOf('Commande')->getUnique($request->getData('id'));
        }

        $formBuilder = new CommandeFB($commande);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Commande')->update($commande);
            $this->app->user()->setFlash('La commande ' . $commande['id_commande'] . ' a bien été modifié !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_commandes');
        }
        $this->page->addVar('form', $form->createView());
    }
}