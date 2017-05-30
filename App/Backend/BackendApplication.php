<?php
namespace App\Backend;

use \OCFram\Application;

class BackendApplication extends Application
{
    public function __construct()
    {
        parent::__construct(); // on lance le __construct de la classe mère Application

        $this->name = 'Backend'; // on surcharge ou écrit le nom attendu par le construct Application
    }

    public function run()
    {
        if ($this->user->isAuthenticated()) // on vérifie si l'utilisatur est authentifié (existe)
        {
            $controller = $this->getController();
            //$controller = new Modules\Client\ClientController($this, 'Client', 'index');
            // si oui on continue le traitement pour obtenir le contrôleur de la méthode parente
        }
        else
        {
            $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
            // si non on instancie le contrôleur de connexion (redirection vers page de connexion)
        }

        $controller->execute();
        // execution du contrôleur

        $this->httpResponse->setPage($controller->page());
        // Assignation de la page créée par le contrôleur à la réponse.

        $this->httpResponse->send(); // Envoi de la réponse.
    }
}