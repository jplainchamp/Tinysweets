<header class="jumbotron hero-spacer">
    <img src="/tinysweets/Web/images/logo-tinysweets.png" alt="logo-tinysweets" />
    <h2>Vous accompagne à chaque moment important : <br /> Anniversaire, Mariages, Baby shower, ...</h2>
    <p> Vous êtes à la recherche d’un cadeau d’anniversaire original pour un bébé, un enfant, un homme ou une femme ?
        <br /> Alors vous êtes au bon endroit chez la spécialiste du gâteau d’anniversaire à commander en ligne !
        <br /> Rien de tel qu’un gâteau d’anniversaire personnalisé pour combler ceux que vous aimez ! </p>
</header>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 class="bg-danger col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-10 col-xs-12">Nos réalisations</h3>
</div>
<br />
<br />
<br />
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <script type="text/javascript" src="/tinysweets/Web/js/jssor.slider-21.1.5.min.js"></script>
        <!-- use jssor.slider-21.1.5.debug.js instead for debug -->
    <script>
        jssor_1_slider_init = function() {
    
        var jssor_1_options = {
            $AutoPlay: true,
                  $AutoPlaySteps: 4,
                  $SlideDuration: 160,
                  $SlideWidth: 200,
                  $SlideSpacing: 3,
                  $Cols: 4,
                  $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                    $Steps: 4
                  },
                  $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                    $SpacingX: 2,
                    $SpacingY: 2
                  }
                };
    
                var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
    
                //responsive code begin
                //you can remove responsive code if you don't want the slider scales while window resizing
                function ScaleSlider() {
                    var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                    if (refSize) {
                        refSize = Math.min(refSize, 809);
                        jssor_1_slider.$ScaleWidth(refSize);
                    }
                    else {
                        window.setTimeout(ScaleSlider, 30);
                    }
                }
                ScaleSlider();
                $Jssor$.$AddEvent(window, "load", ScaleSlider);
                $Jssor$.$AddEvent(window, "resize", ScaleSlider);
                $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
                //responsive code end
            };
     </script>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora03l" style="top:40px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
            <div id="jssor_1" style="position: relative; margin: 0px auto; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden; visibility: hidden;">
                <!-- Loading Screen -->
                <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                    <div style="position:absolute;display:block;background:url('/tinysweets/Web/images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                </div>
                <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden;">
                    <?php
                        foreach ($listeGateaux as $gateau) {
                                echo '<div style="display: none;">
                                    <img data-u="image" src="'.$gateau->photo.'" alt="photo"/>
                                </div>';
                        }
                    ?>
                </div>


            </div>
        <span data-u="arrowright" class="jssora03r" style="top:40px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
    </div>
    <script type="text/javascript">jssor_1_slider_init();</script>
    </div>
</div>
