<?php

$client = $_SESSION['client'];

echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
    echo "<div class='row col-lg-3 col-md-3 col-sm-12 col-xs-12' id='profil'><h2> Bonjour <strong>". $client->pseudo . ",</strong></h2><br />";
        echo '<h4><u>Voici vos informations :</u></h4> ';
        echo '<p>Votre pseudo est : ' . $client->pseudo . '</p>';
        echo '<p>Votre nom est : ' . $client->nom . '</p>';
        echo '<p>Votre prenom est : ' . $client->prenom . '</p>';
        echo '<p>Votre email est : ' . $client->email . '</p>';
        if($client->genre == 'm'){
        echo '<p>Votre genre est : Masculin </p>';
        } else {
        echo '<p>Votre genre est : Féminin </p>';
        }
        echo '<p>Votre adresse est : ' . $client->adresse. '</p>';
        echo '<p>Votre code postal est : ' . $client->cp .'</p>';
        echo '<p>Votre ville est : ' . $client->ville . '</p>';
        if($client->newsletter == 1) {
            echo 'Vous êtes inscrit à la newsletter !!';
        } else {
            echo 'Vous n\'êtes pas inscrit à la newsletter !!';
        }
        echo '<br />';
        echo '<br />';
        echo '<a href="'.ROOTADDRESS.'/admin/client-update-'.$client->id_client.'"> Mettre à jour mes informations</span></a>';
    echo '</div> ';

if($listeCommande) {
    // Liste des commandes du client
    echo '<div class="row col-lg-offset-1 col-md-offset-1 col-lg-7 col-md-7 col-sm-12 col-xs-12" id="profilcommande">';
    echo "<h4> Liste des commandes : </h4>";
    echo "<table class='table table-responsive table-striped table-bordered table-hover table-condensed'><tr>";
    echo "<th class='info'>Commande</th>";
    echo "<th class='info'>Montant TTC</th>";
    echo "<th class='info'>Date de commande</th>";
    echo "<th class='info'>Livraison</th>";

    echo '</tr>';
    foreach ($listeCommande as $commande) {
        echo '<tr>';
        echo '<td>' . $commande->id_commande . '</td>';
        echo '<td>' . $commande->montant . '€</td>';
        echo '<td>' . $commande->dateCommande . '</td>';
        echo '<td>' . $commande->dateLivraison . '</td>';
        echo '</tr>';
    }
    echo '</table><br />';
    echo '</div>';
}
echo '</div>';
