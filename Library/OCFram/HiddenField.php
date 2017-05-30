<?php
namespace OCFram;

class HiddenField extends Field
{
    protected $value;

    public function buildWidget()
    {
        $widget = '';

        $widget .= '<div class="form-group col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">';
        $widget .= '<label for="'.$this->name.'">'.$this->label.'</label>';
        $widget .= '<input type="hidden" name="'.$this->name.'" id="'.$this->name.'" class="form-control"';

        if (isset($this->value) || !empty($this->value))
        {
            $widget .= ' value="'.htmlspecialchars($this->value()).'"';
        }

        $widget .= ' readonly />';

        if (!empty($this->errorMessage))
        {
            $widget .= '<div class="alert alert-danger" id="alert">'.$this->errorMessage.'</div>';
        }
        
        return $widget .= '</div>';
    }

}