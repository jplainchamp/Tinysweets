<?php
namespace App\Backend\Modules\Client;

use \FormBuilder\NewClientFB;
use \FormBuilder\UpdateClientFB;
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Client;

class ClientController extends BackController
{
    public function executeDelete(HTTPRequest $request)
    {
        $clientId = $request->getData('id');

        $this->managers->getManagerOf('Client')->delete($clientId);

        $this->app->user()->setFlash('Le client a bien été supprimé !', 'success', 'ok');

        $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_clients');
    }

    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des clients');

        $manager = $this->managers->getManagerOf('Client');

        $this->page->addVar('listeClients', $manager->getList());
        $this->page->addVar('nombreClients', $manager->count());
    }

    /**
     * @param HTTPRequest $request
     */
    public function executeInsert(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Création d\'un client');

        if($request->method() == 'POST'){
            $client = new Client($_POST);
        } else {
            $client = new Client();
        }

        $formBuilder = new NewClientFB($client);
        $formBuilder->build();
        $form = $formBuilder->form();

        if ($request->method() == 'POST' && $form->isValid()) {
            $this->managers->getManagerOf('Client')->add($client);
            $this->app->user()->setFlash('Le client ' . $client->pseudo . ' a bien été créé !', 'success', 'ok');

            if($_SESSION['client']->statut == '0') {
                $_SESSION['client'] = $client;
                $this->app->httpResponse()->redirect(ROOTADDRESS.'/profil');
            } else {
                $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_clients');
            }
        }
        $this->page->addVar('form', $form->createView());
    }
    /**
     * @param HTTPRequest $request
     */
    public function executeUpdate(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Modification d\'un client');

        if($request->method() == 'POST'){
            $client = new Client($_POST);
        } else {
            $client = $this->managers->getManagerOf('Client')->getUnique($request->getData('id'));
        }

        $formBuilder = new UpdateClientFB($client);
        $formBuilder->build();
        $form = $formBuilder->form();

        if ($request->method() == 'POST' && $form->isValid()) {
            $this->managers->getManagerOf('Client')->update($client);
            $this->app->user()->setFlash('Le client ' . $client->pseudo . ' a bien été modifié !', 'success', 'ok');

            if($_SESSION['client']->statut == '0') {
                $_SESSION['client'] = $client;
                $this->app->httpResponse()->redirect(ROOTADDRESS.'/profil');
            } else {
                $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_clients');
            }
        }
        $this->page->addVar('form', $form->createView());
    }

}