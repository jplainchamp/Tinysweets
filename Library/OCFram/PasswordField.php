<?php
namespace OCFram;

class PasswordField extends Field
{
    protected $maxLength;
    
    public function buildWidget()
    {
        $widget = '';
        
        $widget .= '<div class="form-group col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">';
        $widget .= '<label for="'.$this->name.'">'.$this->label.'</label>';
        $widget .= '<input type="password" class="form-control" name="'.$this->name().'"';

        if (isset($this->value))
        {
            $widget .= ' value="'.htmlspecialchars($this->value()).'"';
        }
        // Ceci est un champ password, on ne réaffiche jamais la valeur saisie, par précaution
        // On définit la longueur max de saisie du champ
        if (!empty($this->maxLength)) {
            $widget .= ' maxlength="' . $this->maxLength . '"';
        }

        $widget .= ' />';

        if (!empty($this->errorMessage))
        {
            $widget .= '<div class="alert alert-danger" id="alert">'.$this->errorMessage.'</div>';
        }

        return $widget .= '</div>';
    }

    public function getMaxLength()
    {
        return $this->maxLength;
    }
    public function setMaxLength($maxLength)
    {
        if (!is_int($maxLength) || $maxLength <= 0) {
            throw new \RuntimeException('La longueur maximale d\'un champ password doit être un nombre entier supérieur à 0.');
        }
        $this->maxLength = $maxLength;
    }
}
