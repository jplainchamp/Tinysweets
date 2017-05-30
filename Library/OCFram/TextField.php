<?php
namespace OCFram;

class TextField extends Field
{
    protected $cols;
    protected $rows;

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->errorMessage))
        {
            $widget .= $this->errorMessage.'<br />';
        }
        $widget .= '<div class="form-group col-lg-offset-2 col-md-offset-2 col-lg-10 col-md-10 col-sm-12 col-xs-12">';
        $widget .= '<label class="control-label">'.$this->label.'</label><textarea name="'.$this->name.'" class="form-control"';

        if (!empty($this->cols))
        {
            $widget .= ' cols="'.$this->cols.'"';
        }

        if (!empty($this->rows))
        {
            $widget .= ' rows="'.$this->rows.'"';
        }

        $widget .= '>';

        if (!empty($this->value))
        {
            $widget .= htmlspecialchars($this->value);
        }

        return $widget.'</textarea></div>';
    }

    public function setCols($cols)
    {
        $cols = (int) $cols;

        if ($cols > 0)
        {
            $this->cols = $cols;
        }
    }

    public function setRows($rows)
    {
        $rows = (int) $rows;

        if ($rows > 0)
        {
            $this->rows = $rows;
        }
    }
}