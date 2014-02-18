<?php namespace Thepsion5\Specification;

abstract class AbstractSpec implements SpecInterface
{

    protected $messages = array();

    public function messages()
    {
        return $this->messages;
    }

    protected function addMessage($category, $message)
    {
        if(!isset($this->messages[$category])) {
            $this->messages[$category] = array();
        }
    }

    public abstract function isSatisfiedBy($candidate);
}
