<?php namespace Thepsion5\Specification\Testing\Stubs;

use Thepsion5\Specification\AbstractSpec;

class SatisfiedSpec extends AbstractSpec
{
    public function isSatisfiedBy($candidate)
    {
        return true;
    }
}
