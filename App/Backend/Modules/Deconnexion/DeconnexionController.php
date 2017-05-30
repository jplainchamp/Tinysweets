<?php
namespace App\Backend\Modules\Deconnexion;

use \OCFram\BackController;


class DeconnexionController extends BackController
{
    /**
     * Cette méthode devra déconnecter l'utilisateur en passant l'authentification à false
     * et ensuite rediriger l'utilisateur vers la page d'accueil du site et afficher le message de déconnexion.
     */
    public function executeIndex()
    {
            unset($_SESSION['auth']);
            $this->app->user()->setFlash('Vous êtes maintenant déconnecté !!', 'danger', 'ko');
            $this->app->httpResponse()->redirect('/tinysweets2/accueil');
    }
}