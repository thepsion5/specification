<?php namespace Thepsion5\Specification\Testing\Stubs;

use Thepsion5\Specification\AbstractSpec;

class DissatisfiedSpec extends AbstractSpec implements SpecInterface
{
    public function isSatisfiedBy($candidate)
    {
        return false;
    }
}
