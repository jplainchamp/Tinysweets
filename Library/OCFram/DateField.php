<?php
namespace OCFram;

class DateField extends Field
{
    protected $maxLength;

    public function buildWidget()
    {
        $widget = '';

        $widget .= '<div class="form-group col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">';
        $widget .= '<label for="'.$this->name.'">'.$this->label.'</label>';
        //$widget .= '<input type="text" id="'.$this->name.'" name="'.$this->name.'" class="form-control"';

        $widget .= '<div class="input-group input-append date">';
        $widget .= '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span><span class="glyphicon glyphicon-time"></span></span>';
        $widget .= '<input class="form-control" id="'.$this->name.'" type="text"';

        if (isset($this->value) || !empty($this->value))
        {
            $widget .= ' value="'.htmlspecialchars($this->value()).'"';
        }

        $widget .= '/>';
        $widget .= '</div>';

        if (!empty($this->errorMessage))
        {
            $widget .= '<div class="alert alert-danger" id="alert">'.$this->errorMessage.'</div>';
        }

        return $widget .= '</div>';
    }
}