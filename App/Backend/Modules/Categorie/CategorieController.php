<?php

namespace App\Backend\Modules\Categorie;

use \FormBuilder\CategorieFB;
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Categorie;

class CategorieController extends BackController
{
    public function executeDelete(HTTPRequest $request)
    {
        $categorieId = $request->getData('id');

        $this->managers->getManagerOf('Categorie')->delete($categorieId);

        $this->app->user()->setFlash('La catégorie a bien été supprimée !', 'success', 'ok');

        $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_categories');
    }

    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Liste des catégories');

        $manager = $this->managers->getManagerOf('Categorie');

        $this->page->addVar('listeCategorie', $manager->getList());
        $this->page->addVar('nombreCategorie', $manager->count());
    }

    /**
     * @param HTTPRequest $request
     */
    public function executeUpdate(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Modification d\'une catégorie');

        if ($request->method() == 'POST')
        {
            $categorie = new Categorie($_POST);
        } else {
            $categorie = $this->managers->getManagerOf('Categorie')->getUnique($request->getData('id'));
        }

        $formBuilder = new CategorieFB($categorie);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Categorie')->update($categorie);
            $this->app->user()->setFlash('La catégorie ' . $categorie['id_categorie'] . ' a bien été modifiée !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_categories');
        }
        $this->page->addVar('form', $form->createView());
    }

    public function executeInsert(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Ajout d\'une catégorie');
        if ($request->method() == 'POST') {
            $categorie = new Categorie($_POST);
        } else {
            $categorie = new Categorie();
        }

        $formBuilder = new CategorieFB($categorie);
        $formBuilder->build();

        $form = $formBuilder->form();
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Categorie')->add($categorie);
            $this->app->user()->setFlash('La catégorie ' . $categorie['id_categorie'] . ' a bien été ajoutée !', 'success', 'ok');

            $this->app->httpResponse()->redirect(ROOTADDRESS.'/admin/gestion_categories');
        }
        $this->page->addVar('form', $form->createView());
    }

}