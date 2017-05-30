<h2><?= isset($title) ? $title : 'Réinitialisation de votre mot de passe' ?></h2>

<div class="row col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <form class="form-horizontal" action="" method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Entrer votre adresse mail" value="" />
        </div>
        <div class="form-group col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Reinitialiser</button>
        </div>
    </form>
</div>

