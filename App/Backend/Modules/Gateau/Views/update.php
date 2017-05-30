<h2><?= isset($title) ? $title : 'Modification d\'un gâteau' ?></h2>

<div class="row col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <form class="form-horizontal" action="" method="POST" role="form" enctype="multipart/form-data">

            <?= $form ?>

            <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-6">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Modifier</button>
            </div>
        </form>
    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
        <a href="/tinysweets2/admin/gestion_gateaux">
            <button class="btn btn-lg btn-info btn-block">Annuler</button>
        </a>
    </div>
</div>
