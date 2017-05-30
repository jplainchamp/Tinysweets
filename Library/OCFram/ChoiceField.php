<?php

namespace OCFram;


class ChoiceField extends Field
{
    protected $multiple = false;
    protected $options = array();
    protected $optionsSelected = array();

    /**
     * Méthode de génération de l'affichage du champ textarea
     *
     * @return string
     */
    public function buildWidget()
    {
        $widget = '';

        $widget .= '<div class="form-group col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">';
        $widget .= '<label for="'.$this->name().'">'.$this->label().'</label>';
    
        $multiple = '';
        if (true === $this->multiple) {
            $multiple = 'multiple';
        }
        
        //select
        $widget .= '<select class="form-control" name="'.$this->name().'"'.$multiple.'>';
        $widget .= '<option value="0" disabled '.(!$this->optionsSelected ? 'selected="selected"' : '').' style="font-weight:bold;">'.$this->label().'</option>';
        foreach ($this->options as $value => $placeholder) {
            $selected = '';
            if (($this->optionsSelected && array_key_exists($value, $this->optionsSelected))) {
                $selected = 'selected="selected"';
            }
            $widget .= '<option value="'.$value.'" '.$selected.'>'.$placeholder.'</option>';
        }
        $widget .='</select>';
        // S'il y a un message d'erreur, on l'affiche
        if (!empty($this->errorMessage))
        {
            $widget .= '<div class="alert alert-danger" id="alert">'.$this->errorMessage.'</div>';
        }

        return $widget .= '</div>';
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function setOptionsSelected(array $options)
    {
        $this->optionsSelected = $options;
    }
    
    public function setMultiple($bool)
    {
        $this->multiple = $bool;
    }
}
