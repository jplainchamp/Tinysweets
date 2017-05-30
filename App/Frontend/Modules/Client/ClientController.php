<?php
namespace App\Frontend\Modules\Client;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Client;
use \FormBuilder\NewClientFB;

class ClientController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Accueil');
    }

    public function executeInscription(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Inscription');
    }

    public function executeProfil(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Profil Client');

        $idClient = $_SESSION['client']->id_client;
        $managerCommande = $this->managers->getManagerOf('Commande')->getListById($idClient);
        $this->page()->addVar('listeCommande', $managerCommande);
    }

    public function executeMdpPerdu(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Reinitialisation du mot de passe');

        function generer_mdp() {
            $nb_caractere = 12;
            $mdp = "";
            $chaine = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ023456789+@!$%?&";
            $longeur_chaine = strlen($chaine);
            for($i = 1; $i <= $nb_caractere; $i++)
            {
                $place_aleatoire = mt_rand(0,($longeur_chaine-1));
                $mdp .= $chaine[$place_aleatoire];
            }
            return $mdp;
        }
        
        if ($request->method() == 'POST') {
            // verification pseudo et mot de passe vide
            if($request->postData('email')){
                $client = $this->managers->getManagerOf('Client')->getInfosByMail($request->postData('email'));
                if($client->email == $request->postData('email') AND filter_var($request->postData('email'), FILTER_VALIDATE_EMAIL)) {
                    $newmdp = generer_mdp();
                    $to = $request->postData('email'); // Déclaration de l'adresse de destination.
                    $subject = "Réinitialisation du mot de passe";
                    $message = "Bonjour " . $client->pseudo . "</b>, nous avons r&eacuteinitialis&eacute votre mot de passe suite &agrave votre demande.";
                    $message .= "<br/>Voici votre nouveau mot de passe :" . $newmdp;
                    $name = $client->pseudo;
                    $mailsend = $this->app->sendmail()->sendmail($to, $subject, $message, $name);
                    if ($mailsend == 1) {
                        $this->managers->getManagerOf('Client')->modifyMdp($newmdp, $client->id_client);
                        $this->app->user()->setFlash('email envoyé', 'success', 'ok');
                        $this->app->httpResponse()->redirect(ROOTADDRESS.'/accueil');
                    } else {
                        $this->app->user()->setFlash('Erreur email pas envoyé', 'danger', 'ko');
                        $this->app->httpResponse()->redirect(ROOTADDRESS.'/mdpperdu');
                    }
                } else {
                    $this->app->user()->setFlash('Adresse mail invalide. Format autorisé : toto@domaine.fr - Caractères autorisés : point, underscore et tiret.', 'warning', 'ko');
                    $this->app->httpResponse()->redirect(ROOTADDRESS.'/mdpperdu');
                }
            } else {
                $this->app->user()->setFlash('Le champ est vide, vous devez entrer votre adresse mail !!', 'warning', 'ko');
                $this->app->httpResponse()->redirect(ROOTADDRESS.'/mdpperdu');
            }
        }
    }

    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST')
        {
            $client = new Client([
                'id_client' => $request->getData('id_client'),
                'pseudo' => $request->postData('pseudo'),
                'mdp' => $request->postData('mdp'),
                'nom' => $request->postData('nom'),
                'prenom' => $request->postData('prenom'),
                'email' => $request->postData('email'),
                'genre' => $request->postData('genre'),
                'ville' => $request->postData('ville'),
                'cp' => $request->postData('cp'),
                'adresse' => $request->postData('adresse'),
                'statut' => $request->postData('statut'),
                'newsletter' => $request->postData('newsletter')
            ]);

            if ($request->getExists('id_client'))
            {
                $client->setId($request->getData('id_client'));
            }
        }
        else
        {
            $client = new Client();
        }

        $formBuilder = new NewClientFB($client);
        $formBuilder->build();

        $form = $formBuilder->form();

        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Client')->add($client);
            $this->app->user()->setFlash('Bravo, '.$client->pseudo.' votre inscription est réussis, vous pouvez maintenant vous connecter.', 'success', 'ok');
            $this->app->httpResponse()->redirect(ROOTADDRESS.'/accueil');
        }

        $this->page->addVar('form', $form->createView());
    }
}