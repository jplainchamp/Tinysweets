<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="TinySweets" />
        <meta name="author" content="Jeremy Plainchamp">
        <meta property="og:title" content="TinySweets" />
        <meta property="og:type" content="site web" />
        <meta property="og:url" content="http://www.tinysweets.jeremyplainchamp.com" />
        <meta property="og:image" content="/tinysweets/Web/images/lokisalle.png" />
        <title>TinySweets</title>
        <link rel="stylesheet" href="/tinysweets/Web/css/bootstrap.min.css">
        <link rel="stylesheet" href="/tinysweets/Web/css/jquery.datetimepicker.css">
        <link rel="stylesheet" href="/tinysweets/Web/css/style.css">
        <link rel="stylesheet" href="/tinysweets/Web/css/lumino.css">
        <link rel="stylesheet" href="/tinysweets/Web/js/jquery-ui-1.11.4.custom/jquery-ui.min.css">
        <link rel="stylesheet" href="/tinysweets/Web/DataTables/datatables.min.css">
        <link rel="icon" type="image/png" href="/tinysweets/Web/images/favicon.png" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="/tinysweets/Web/images/favicon.ico" /><![endif]-->
        <!-- <link rel="stylesheet" href="/tinysweets/Web/css/bootstrap.min.css"> -->
        <!-- <script src="/tinysweets/Web/js/jquery.min.js"></script> -->
        <!-- <script src="/tinysweets/Web/js/bootstrap.min.js"></script> -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--Icons-->
        <!--[if lt IE 9]>
            <script type="text/javascript" src="/tinysweets/Web/js/html5shiv.min.js"></script>
            <script type="text/javascript" src="/tinysweets/Web/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

<nav class="navbar navbar-inverse navbar-fixed-top container" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <?php
      if($user->isAuthenticated()) {
        echo '<ul class="nav navbar-nav">
                    <li role="presentation">
                        <a href="'.ROOTADDRESS.'/accueil"><span class="glyphicon glyphicon-home"></span> Accueil</a>
                    </li>
                    <li role="presentation">
                        <a href="'.ROOTADDRESS.'/liste_gateaux"><span class="glyphicon glyphicon-gift"></span> Nos gâteaux</a>
                    </li>
                    <li role="presentation">
                        <a href="'.ROOTADDRESS.'/recherche"><span class="glyphicon glyphicon-search"></span> Recherche</a>
                    </li>
                    <li role="presentation">
                        <a href="'.ROOTADDRESS.'/panier"><span class="badge">'.$_SESSION['nbproduits'].'</span><span class="glyphicon glyphicon-shopping-cart"></span> Panier </a>
                     </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation">
                        <a href="'.ROOTADDRESS.'/profil"><span class="glyphicon glyphicon-eye-open"></span> Mon profil</a>
                    </li>
                    <li role="presentation">
                         <a href="'.ROOTADDRESS.'/admin/deconnexion"><span class="glyphicon glyphicon-user"></span> Se déconnecter</a>
                    </li>
                </ul>';
      }
      else {
        echo '<ul class="nav navbar-nav">
                    <li role="presentation">
                        <a href="'.ROOTADDRESS.'/accueil"><span class="glyphicon glyphicon-home"></span> Accueil</a>
                    </li>
                    <li role="presentation">
                        <a href="'.ROOTADDRESS.'/liste_gateaux"><span class="glyphicon glyphicon-gift"></span> Nos gâteaux</a>
                    </li>
                    <li role="presentation">
                        <a href="'.ROOTADDRESS.'/recherche"><span class="glyphicon glyphicon-search"></span> Recherche</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation">
                         <!--<a href="Connexion" data-toggle="modal" id="myBtn"><span class="glyphicon glyphicon-user"></span> Se connecter</a>-->
                         <a href="connexion" data-toggle="modal" id="myBtn"><span class="glyphicon glyphicon-user"></span> Se connecter</a>
                    </li>
                    <li role="presentation">
                        <a href="'.ROOTADDRESS.'/inscription"><span class="glyphicon glyphicon-log-in"></span> S\'inscrire</a>
                    </li>
                </ul>';
      }
      if($user->isAuthenticatedIsAdmin())
      {
        echo '<ul class="nav navbar-nav">';
        echo '<li role="presentation" class="dropdown">';
        echo '<a class="dropdown-toggle" href="'.ROOTADDRESS.'/admin" data-toggle="dropdown">Administration';
        echo '<span class="caret"></span></a>';
        echo '<ul class="dropdown-menu">';
        echo '<li><a href="'.ROOTADDRESS.'/admin/gestion_clients">Gestion des clients</a></li>';
        echo '<li><a href="'.ROOTADDRESS.'/admin/gestion_commandes">Gestion des commandes</a></li>';
        echo '<li><a href="'.ROOTADDRESS.'/admin/gestion_gateaux">Gestion des gâteaux</a></li>';
        echo '<li><a href="'.ROOTADDRESS.'/admin/gestion_categories">Gestion des categories</a></li>';
        echo '<li><a href="'.ROOTADDRESS.'/admin/gestion_promos">Gestion des promos</a></li>';
        echo '<li><a href="'.ROOTADDRESS.'/admin/gestion_parfums">Gestion des parfums</a></li>';
        echo '<li><a href="'.ROOTADDRESS.'/admin/gestion_tailles">Gestion des tailles</a></li>';
        echo '<li><a href="'.ROOTADDRESS.'/admin/gestion_avis">Gestion des avis</a></li>';
        echo '</ul>';
        echo '</li>';
        echo '</ul>';
      }
      ?>
    </div>
  </div>

</nav>

<div class="container">
  <?php
  echo '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 pull-right">';
  echo '<button id="impression" name="impression" onclick="imprimer_page()" class="btn btn-sm btn-primary glyphicon glyphicon-print"> </button>';
  echo'</div>';
  ?>
  <?php
  if(isset($_SESSION['flash'])) {
    foreach($_SESSION['flash'] as $indice => $message){
      echo '<div class="alert alert-'.$indice.' col-lg-8 col-md-8 col-sm-8 col-xs-8 pull-left" id="alert">';
      foreach($message as $valeur){
        echo $valeur.'<br/>';
      }
    }
    unset($_SESSION['flash']);
  }
  echo '</div>';
  ?>
</div>

<div class="main">

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h1><span class="glyphicon glyphicon-lock"></span>Connexion TinySweets</h1>
        </div>
        <div class="modal-body">
          <form role="form" method="POST" action="/tinysweets/admin/connexion">
            <div class="form-group">
              <label for="pseudo"><span class="glyphicon glyphicon-user"></span> Pseudo</label>
              <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrer pseudo" value="<?php
              if(isset($_COOKIE['membre'])) echo $_COOKIE['membre']; ?>">
            </div>
            <div class="form-group">
              <label for="mdp"><span class="glyphicon glyphicon-eye-open"></span> Mot de passe</label>
              <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Entrer mot de passe">
            </div>
            <div class="checkbox">
              <label for="remember"><input type="checkbox" name="remember" id="remember" value="">Se souvenir de moi</label>
            </div>
            <button type="submit" name="connexion" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-off"></span> Connexion</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
          <p>Pas encore membre? <a href="/tinysweets/inscription">S'inscrire</a></p>
          <p><a href="/tinysweets/mdpperdu">Mot de passe oublié?</a></p>
        </div>
      </div>
    </div>
  </div>

  <div class="container">

  <?php echo $content; ?>

  </div>
</div>

<footer>
  <nav class="navbar navbar-inverse container" role="navigation">
    <div class="container-fluid">
      <div class="footer-top">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar2">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="myNavbar2">
          <div class="col-lg-3 col-md-3 col-sm-3 location">
            <h5><span class="glyphicon glyphicon-home"></span> Adresse</h5>
            <p> 5 avenue Nicolas About<br /> 78180 Montigny-le-Bretonneux<br /> FRANCE </p>
            <h5><span class="glyphicon glyphicon-phone"></span> Tel : 01.23.45.67.89</h5>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 customer">
            <h5><span class="glyphicon glyphicon-user"></span> Service Client</h5>
            <ul>
              <li><a href="/tinysweets/aboutus">Qui sommes nous ?</a></li>
              <li><a href="/tinysweets/cgv">Nos conditions de ventes</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 social">
            <h5><span class="glyphicon glyphicon-share"></span> Rester connecté</h5>
            <div class="face-b">
              <img src="/tinysweets/Web/images/facebook.png" title="facebook" alt="facebook"/>
              <a href="#"><i class="fb"> </i></a>
              <img src="/tinysweets/Web/images/twitter.png" title="twitter" alt="twitter"/>
              <a href="#"><i class="twt"> </i></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 sign">
            <a href="/tinysweets/contact"><h5><span class="glyphicon glyphicon-envelope"></span> Nous contacter</h5></a>
            <h5><span class="glyphicon glyphicon-time"></span> Heures d'ouverture</h5>
            <p>Du lundi au vendredi de 8h à 18h</p>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
    </div>
  </nav>
</footer>
<!-- jQuery -->
<!-- <script src="/tinysweets/Web/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="/tinysweets/Web/js/jquery.js"></script>
<script type="text/javascript" src="/tinysweets/Web/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/tinysweets/Web/js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="/tinysweets/Web/js/DatePicker.js"></script>
<script type="text/javascript" src="/tinysweets/Web/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script type="text/javascript" src="/tinysweets/Web/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="/tinysweets/Web/js/lumino.glyphs.js"></script>
<script type="text/javascript" src="/tinysweets/Web/js/TableauData.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#myBtn").click(function(){
      $("#myModal").modal();
    });
  });

  function imprimer_page(){
    window.print();
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('li.active').removeClass('active');
    $('a[href="' + location.pathname + '"]').closest('li').addClass('active');
  });
</script>
<script type="text/javascript">
  $(function() {	// Décrémente le champ nombre_part
    $("#soustraire").click(function() {
      var valeur = $('#nombre_part').val();
      if (valeur >= 0) {
        var nouvelleValeur = parseFloat(valeur) - 1;
      }
      $('#nombre_part').val(nouvelleValeur);
    });
  });

  $(function() {	// Incrémente le champ nombre_part
    $("#ajouter").click(function() {
      var valeur = $('#nombre_part').val();
      if (valeur >= 0) {
        var nouvelleValeur = parseFloat(valeur) + 1;
      }
      $('#nombre_part').val(nouvelleValeur);
      $('#quantite').attr("value",nouvelleValeur);
    });
  });
</script>
<noscript>
  <div class="alert alert-danger col-lg-offset-3 col-md-offset-3 col-lg-6 col-md-6 col-sm-10 col-xs-12" id="alert">Votre navigateur ne supporte pas le JavaScript!!</div>
</noscript>
    </body>
</html>
