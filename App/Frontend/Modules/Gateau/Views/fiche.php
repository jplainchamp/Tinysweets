
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 class="bg-danger col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-10 col-xs-12"><?= isset($title) ? $title : 'Fiche détaillée' ?></h3>
</div>

<br />

<?php

if(isset($_POST['submit'])){
    $quantite = $_POST['quantite'];
} else {
    $quantite = 1;
}

/* ########################################################################################################################################
            Affichage de  la page
######################################################################################################################################## */

echo '<div id="fichedetails" class="thumbnail col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p><strong>'.$gateau->nom.'</strong> ';
        if(isset($noteMoyenne->moyenne)) {
            echo number_format($noteMoyenne->moyenne, 1, ',', ' ') . '/5 de moyenne sur ';
            echo $nombreNote . ' avis)</p>';
        } else {
            echo ' n\'as pas encore été noté</p>';
        }
    echo '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <img src="'.$gateau->photo.'" alt="photo" width="250px" height="250px"/>';
       foreach ($listeCategorie as $categorie) {
        if($categorie->id_categorie == $gateau->id_categorie) echo '<p><strong>Catégorie :</strong> '.$categorie->nom.'</p>';
    }
    echo '</div>
    <div class="fichedetails col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <form class="form-horizontal" role="form" action="/tinysweets2/panier-add" method="POST">
            <div class="form-group">
                <label class="control-label col-lg-4 col-md-4 col-sm-6 col-xs-6">Description :</label>
                <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <textarea class="form-control" id="description" readonly="readonly" rows="1">'.$gateau->description.'</textarea>
                </div>
            </div>
             <div class="form-group">
                    <label class="control-label col-lg-4 col-md-4 col-sm-6 col-xs-6" for="taille">Taille :</label>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <select class="form-control" id="taille" name="idTaille">';
                    foreach ($listeTaille as $taille) {
                        echo '<option value="'.$taille->id_taille.'">'.$taille->nom.' = +'.$taille->prix.'€ ('.$taille->description.')</option>';
                    }
                    echo '</select>
                </div>
            </div>';

            echo '<div class="form-group">
                    <label class="control-label col-lg-4 col-md-4 col-sm-6 col-xs-6" for="parfum">Parfum :</label>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <select class="form-control" id="parfum" name="idParfum">';
                    foreach ($listeParfum as $parfum) {
                       echo '<option value="'.$parfum->id_parfum.'">'.$parfum->nom.' = +'.$parfum->prix.'€</option>';
                    }
                    echo '</select>
                </div>
            </div>';
            echo '<div class="form-group">
                    <label class="control-label col-lg-4 col-md-4 col-sm-6 col-xs-6" for="quantite">Quantité :</label>
               <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                 <select class="form-control" id="quantite" name="quantite">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>';
                echo '<input type="hidden" name="idGateau" class="form-control" value="'.$gateau->id_gateau.'" readonly />
                <input type="hidden" name="idPromo" class="form-control" value="'.$gateau->id_promo.'" readonly />
            </div>
            <div class="col-lg-offset-4 col-md-offset-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                
                <button class="btn btn-md btn-primary btn-block" type="submit" name="submit">Ajouter au panier</button>
            </div>     
        </form>
    </div>
</div>';



/*-------------------------------------------------------------------------------------
        Gestion des avis
----------------------------------------------------------------------------------------*/

foreach ($listeNote as $note) {
    echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 class="bg-danger col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-10 col-xs-12">Avis sur le gâteau</h3>
    </div>
    <div class="avis col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <p id="avis">'.$note->pseudo.', le '.$note->dateAvis.' ('.$note->note.'/5) </p>
        <p>'.$note->commentaire.'</p>
    </div>';
    }
    if($user->isAuthenticated()) {
        if($clientNote < 1) {
            echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 class="bg-danger col-lg-10 col-md-10 col-sm-12 col-xs-12">Vous avez aimé ce gâteau ? Laissez nous un commentaire.</h3>
                <form class="form-horizontal" action="" method="POST" role="form" enctype="multipart/form-data">';
                    echo'<input type="hidden" name="idGateau" class="form-control" value="'.$gateau->id_gateau.'" readonly />';
                    echo'<input type="hidden" name="idClient" class="form-control" value="'.$_SESSION['client']->id_client.'" readonly />';
                    echo $form;
                    echo '<div class="form-group col-lg-offset-2 col-md-offset-2 col-lg-5 col-md-5 col-sm-6 col-xs-6">
                        <button class="btn btn-md btn-primary btn-block" type="submit" name="addAvis">Ajouter</button>
                    </div>
                </form>
             </div>
        </div>';
        }
        else {
            echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <h4>Merci pour votre contribution. Vous ne pouvez pas ajouter de nouveau commentaire.</h4>
             </div>';
        }
     echo'</div>';
    } else {
        $user->setFlash('Vous devez être connecté pour laisser un commentaire !!', 'info', 'ok');
    }
    echo'</div>
<br /><br />';