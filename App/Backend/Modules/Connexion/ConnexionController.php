<?php
namespace App\Backend\Modules\Connexion;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Client;
use \FormBuilder\LoginFormBuilder;

class ConnexionController extends BackController
{
    /**
     * @param HTTPRequest $request
     * Cette méthode devra, si le formulaire a été envoyé,
     * vérifier si le pseudo et le mot de passe entrés  sont corrects.
     * Si c'est le cas, l'utilisateur est authentifié, sinon un message d'erreur s'affiche.
     */
    public function executeIndex(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Connexion');
    }
    
    public function executeAdmin(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Accueil');
    }
    
    public function processForm(HTTPRequest $request)
    {
        $client = new Client();
        $formBuilder = new LoginFormBuilder($client);
        $formBuilder->build();
        $form = $formBuilder->form();

        if($request->method() == 'POST') {
        // verification pseudo et mot de passe vide
            if(!$request->postData('pseudo') || !$request->postData('mdp')){
                $this->app->user()->setFlash('Les deux champs doivent être remplis : pseudo et mot de passe !!', 'warning', 'ko');
                $this->app->httpResponse()->redirect('/tinysweets2/admin/connexion');
            }

            $client = $this->managers->getManagerOf('Client')->getClient($request->postData('pseudo'));
            $login = $request->postData('pseudo');
            $password = $request->postData('mdp');

        // creation du cookie pour garder le pseudo
            if($client && $login == $client->pseudo){
                if($request->postExists('remember')){
                    setcookie('client', $client->pseudo, time() + 3600 * 24, null, null, false, true);
                }
            }
            else {
                $this->app->user()->setFlash('Pseudo inexistant dans la base', 'danger', 'ko');
                $this->app->httpResponse()->redirect('/tinysweets2/admin/connexion');
            }
        // verification du mot de passe par rapport à celui de la base
            //if($client && $password == $client->mdp) {
            if($client && password_verify($password, $client->mdp)) {
                $_SESSION['client'] = $client; // affiche dans la variable SESSION les informations du tableau user
                $this->app->user()->setAuthenticated(true);
                $this->app->user()->setFlash('Vous êtes connecté !!', 'success', 'ok');
                $_SESSION['panier']['total'] = 0;
                $_SESSION['panier']['produits'] = array();
                $_SESSION['nbproduits'] = 0;
                $this->app->httpResponse()->redirect('/tinysweets2/profil');
                exit();
            }
            else {
                $this->app->user()->setFlash('Mot de passe incorrect !!', 'danger', 'ko');
                $this->app->httpResponse()->redirect('/tinysweets2/admin/connexion');
            }
        }
        $this->page->addVar('form', $form->createView());
    }
}