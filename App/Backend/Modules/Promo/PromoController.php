<?php

namespace App\Backend\Modules\Promo;

use \FormBuilder\PromoFB;
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Promo;

class PromoController extends BackController
{
    public function executeDelete(HTTPRequest $request)
    {
        $promoId = $request->getData('id');

        $this->managers->getManagerOf('Promo')->delete($promoId);

        $this->app->user()->setFlash('La promotion a bien été supprimée !', 'success', 'ok');

        $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_promos');
    }
    
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Liste des promotions');

        $manager = $this->managers->getManagerOf('Promo');

        $this->page->addVar('listePromo', $manager->getList());
        $this->page->addVar('nombrePromo', $manager->count());
    }

    /**
     * @param HTTPRequest $request
     */
    public function executeUpdate(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Modification d\'une promotion');

        if ($request->method() == 'POST')
        {
            $promo = new Promo($_POST);
        } else {
            $promo = $this->managers->getManagerOf('Promo')->getUnique($request->getData('id'));
        }

        $formBuilder = new PromoFB($promo);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Promo')->update($promo);
            $this->app->user()->setFlash('La promotion ' . $promo['id_promo'] . ' a bien été modifiée !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_promos');
        }
        $this->page->addVar('form', $form->createView());
    }

    public function executeInsert(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Ajout d\'une promotion');
        if ($request->method() == 'POST') {
            $promo = new Promo($_POST);
        } else {
            $promo = new Promo();
        }

        $formBuilder = new PromoFB($promo);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Promo')->add($promo);
            $this->app->user()->setFlash('La promotion ' . $promo['id_promo'] . ' a bien été ajoutée !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_promos');
        }
        $this->page->addVar('form', $form->createView());
    }

}