<header class="jumbotron hero-spacer">
    <img src="/tinysweets/Web/images/logo-tinysweets.png" alt=logo-tinysweets" />
</header>

<?php
// Vérification des champs du formulaire, une fois que l'utilisateur clique sur submit
if($_POST){
    //Vérification de l'email
    if(empty($_POST['sujet'])) $errors['sujet'] = CHAMP_VIDE;
    if(empty($_POST['message'])) $errors['message'] = CHAMP_VIDE;
    if(!empty($_POST['sujet']) && !empty($_POST['sujet'])) {
    $mail = "jeremy.plainchamp@orange.fr"; // Déclaration de l'adresse de destination.
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) { $passage_ligne = "\r\n"; }
    else { $passage_ligne = "\n"; }
    //=====Déclaration des messages au format texte et au format HTML.
    $message_txt = $_POST['message'];
    $message_html = $_POST['message'];
    //=====Création de la boundary
    $boundary = "-----=".md5(rand());
    //=====Définition du sujet.
    $sujet = $_POST['sujet'];
    //=====Création du header de l'e-mail.
    $header = "From: \"Visiteur Tinysweets\"<tarantio782@free.fr>".$passage_ligne;
    $header.= "Reply-to: \"Visiteur Tinysweets\" <tarantio782@free.fr>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format HTML
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    //=====Envoi de l'e-mail.
    mail($mail,$sujet,$message,$header);
    //==========
    $this->app->user()->setFlash('Message bien envoyé', 'info', 'ok');
    }
}
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 class="bg-danger col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-10 col-xs-12">Laisser un message</h3>
</div>
<br /><br /><br /><br />
<div class="row col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-10 col-md-10 col-sm-10 col-xs-10">
    <form class="form-horizontal" action="#" method="POST" role="form">
        <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <label for="sujet"><span class="glyphicon glyphicon-user"></span> Sujet :</label>
            <input type="text" class="form-control" name="sujet" id="sujet" placeholder="Sujet" value="" />
        </div>
        <br /><br /><br /><br />
        <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <label for="message"><span class="glyphicon glyphicon-list"></span> Message : </label>
            <textarea class="form-control" name="message" id="message" rows="10" cols="30"></textarea>
        </div>
        <br /><br /><br /><br />
        <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <input class="btn btn-lg btn-primary btn-block" type="submit" name="Envoi" value="Envoi">
        </div>
    </form>
</div>
