<?php namespace Thepsion5\Specification\Testing\Stubs;

use Thepsion5\Specification\AbstractSpec;

class MessageContainerSpec extends AbstractSpec
{
    public function __construct(array $messages = array())
    {
        foreach($messages as $key => $value) {
            $this->addMessage($key, $value);
        }
    }

    public function isSatisfiedBy($candidate)
    {
        return false;
    }
}
