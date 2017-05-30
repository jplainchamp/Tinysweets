<?php
namespace OCFram;

class StringField extends Field
{
    protected $maxLength;

    public function buildWidget()
    {
        $widget = '';

        $widget .= '<div class="form-group col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">';
        $widget .= '<label for="'.$this->name.'">'.$this->label.'</label>';
        $widget .= '<input type="text" id="'.$this->name.'" name="'.$this->name.'" class="form-control"';
 
        if (isset($this->value) || !empty($this->value))
        {
            $widget .= ' value="'.htmlspecialchars($this->value()).'"';
        }

        // On définit la longueur max de saisie du champ
        if (!empty($this->maxLength)) {
            $widget .= ' maxlength="'.$this->getMaxLength().'"';
        }

        $widget .= ' />';

        if (!empty($this->errorMessage))
        {
            $widget .= '<div class="alert alert-danger" id="alert">'.$this->errorMessage.'</div>';
        }

        return $widget .= '</div>';
    }

    /***********************  GETTERS  ***********************/

    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /***********************  SETTERS  ***********************/

    public function setMaxLength($maxLength)
    {
        if (!is_int($maxLength) || $maxLength <= 0) {
            throw new \RuntimeException('La longueur maximale d\'un champ texte doit être un nombre entier supérieur à 0.');
        }
        $this->maxLength = $maxLength;

        return $this;
    }

}