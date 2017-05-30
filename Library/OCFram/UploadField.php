<?php
namespace OCFram;

use \Entity\Gateau;

class UploadField extends Field
{

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->errorMessage)) {
            $widget .= $this->errorMessage . '<br />';
        }

        $widget .= '<div class="form-group col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">';
        $widget .= '<label for="'.$this->name().'"><span class="glyphicon glyphicon glyphicon-picture" aria-hidden="true"></span> '.$this->label().'</label>';
        $widget .= '<input type="hidden" name="MAX_FILE_SIZE" value="300000" />';
        if($this->value != '') {
            $widget .= '<div><img src="'.$this->value. '" width="30%" height="30%" /></div>';
			$widget .= '<input type="file" id="'.$this->name().'" name="'.$this->name().'" />';
            $widget .= '<i>Vous pouvez uploader une nouvelle photo si vous souhaitez la changer</i>';
            $widget .= '<input type="hidden" name="'.$this->name().'" value="'.$this->value.'" />';
        } else {
            $widget .= '<input type="file" id="' . $this->name() . '" name="' . $this->name() . '" />';
            $widget .= '<i>Vous pouvez uploader une  photo si vous le souhaitez</i>';
            $widget .= '<input type="hidden" name="' . $this->name() . '" value="" />';
        }

        return $widget .= '</div>';
    }
}

