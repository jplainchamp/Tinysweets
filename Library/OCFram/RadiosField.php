<?php
namespace OCFram;

class RadiosField extends Field
{

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->errorMessage)) {
            $widget .= $this->errorMessage . '<br />';
        }

        $widget .= '<div class="form-group col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-12 col-xs-12">';
        $widget .= '<label for="' . $this->label . '" class="control-label">' . $this->label . '</label>';
        $widget .= '<label class="control-label col-md-offset-1 col-sm-offset-1 col-xs-offset-1">';
        $widget .= '<input type="radio" name="' . $this->name . '" id="' . $this->name . '"';
        $widget .= ' value="m" ';
        if (self::value() == 'm' || (isset($_POST['genre']) && $_POST['genre'] == 'm')) $widget .= 'checked';
        $widget .= '/> Masculin </label>';

        $widget .= '<label class="control-label col-md-offset-1 col-sm-offset-1 col-xs-offset-1">';
        $widget .= '<input type="radio" name="' . $this->name . '" id="' . $this->name . '"';
        $widget .= ' value="f" ';
        if (self::value() == 'f' || (isset($_POST['genre']) && $_POST['genre'] == 'f')) $widget .= 'checked';
        $widget .= '/> Feminin </label>';

        return $widget .= '</div>';
    }
}