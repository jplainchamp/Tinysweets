<?php

namespace OCFram;


class RuleValidator extends Validator
{
    protected $errorMessage;
    protected $rule;

    public function __construct($errorMessage, $rule)
    {
        parent::__construct($errorMessage);

        $this->setRule($rule);
    }

    public function setRule($rule)
    {
            $this->rule = $rule;
    }

    public function isValid($value)
    {
        return preg_match($this->rule,$value);
    }
}