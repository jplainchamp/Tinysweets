<!--#######################################################################################################################################
        AFFICHAGE DU FORMULAIRE
########################################################################################################################################-->
<div class="row">
    <div class="col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <h2><?= isset($title) ? $title : 'Connexion' ?></h2>
        </div>
        <form class="form-horizontal" action="/tinysweets2/admin/" method="POST" role="form">
            <?= $form ?>
            <div class="form-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <label><input type="checkbox" name="remember" value=""> Se souvenir de moi</label>
            </div>
            <div class="form-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary btn-block" name="Connexion" value="Connexion"><span class="glyphicon glyphicon-off"></span> Connexion</button>
                <br />
                <p>Pas encore membre? <a href="/tinysweets2/inscription">S'inscrire</a></p>
                <p><a href="/tinysweets2/mdpperdu">Mot de passe oublié?</a></p>
            </div>
        </form>
    </div>
</div>  <!-- row -->